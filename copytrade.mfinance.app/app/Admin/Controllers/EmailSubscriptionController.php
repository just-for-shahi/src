<?php

namespace App\Admin\Controllers;

use App\Mail\OrderSignalEmail;
use App\Models\Account;

use App\Models\CopierType;
use App\Models\EmailSubscription;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EmailSubscriptionController extends AdminController
{

    protected function title() {
        return trans('admin.email_subscriptions');
    }

    protected function grid()
    {
        return new Grid(new EmailSubscription(), function (Grid $grid) {
            $grid->model()->whereManagerId(Admin::user()->id);

            $grid->id('ID')->sortable();

            $grid->title('Title');

            $grid->sources('Source Accounts')->pluck('account_number')->label();

            $grid->is_public()->switch()->sortable();

            $grid->created_at()->sortable();
            $grid->updated_at();

            $grid->disableExport();
            $grid->disableFilter();
            $grid->actions(function ($actions) {
                $actions->disableView();
            });
        });
    }


    protected function form()
    {
        return new Form(new EmailSubscription(), function (Form $form) {
            $form->hidden('manager_id')->value(Auth::guard('admin')->user()->id);
            $form->text('title', 'Title');
            $form->switch('is_public', 'Public?')->default(0);

            $form->multipleSelect('sources', 'Source Accounts')->options(
                Account::where([
                    ['manager_id', Auth::guard('admin')->user()->id],
                    ['copier_type', CopierType::MASTER]
                    ])
                    ->selectRaw("CONCAT (`account_number`,
                    CASE WHEN title IS NULL THEN '' ELSE CONCAT(' (',`title`,')') END  ) AS acc_title, id")
                    ->pluck('acc_title', 'id')
            )->allowSelectAll();

            $form->tinymce('template_signal_new', 'Template order "New"')
                ->default('<h1>Order Opened</h1>
<b>ID:</b> {{ $ticket }}<br>
<b>Symbol:</b> {{ $symbol }}<br>
<b>Type:</b> {{ $type_str }}<br>
<b>Lots:</b> {{ $lots }}<br>
<b>Entry Price:</b> {{ $price }} @ (<b>Entry Time:</b> {{ $time_open }} )')
                ->help('Available vars: subscription_title, source_title, account, scope, ticket, type_str, symbol, price, lots, stoploss, takeprofit, time_open')
                ->setFirstOnPage();

            $form->button('btn_new','Test "New"')->on('click', $this->formatClick($form, 'new'));

            $form->tinymce('template_signal_updated', 'Template order "Modify"')->
                default('<h1>Order Updated</h1>
<b>ID:</b> {{ $ticket }}<br>
<b>Symbol:</b> {{ $symbol }}<br>
<b>Stoploss:</b> {{ $stoploss }}<br>
<b>TakeProfit:</b> {{ $takeprofit }}<br>')->
                help('Available vars: subscription_title, source_title, account, scope, ticket, type_str, symbol, lots, price, stoploss, takeprofit, time_open');
            $form->button('btn_updated','Test "Updated"')->on('click', $this->formatClick($form, 'updated'));

            $form->tinymce('template_signal_closed', 'Template order "Close"')->
                default('<h1>Order Closed</h1>
<b>ID:</b> {{ $ticket }}<br>
<b>Symbol:</b> {{ $symbol }}<br>
<b>Stoploss:</b> {{ $stoploss }}<br>
<b>TakeProfit:</b> {{ $takeprofit }}<br>
<b>Entry Price:</b> {{ $price }} @ (<b>Entry Time:</b> {{ $time_open }} )<br>
<b>Closed Price:</b> {{ $price_close }} @ (<b>Close Time:</b> {{ $time_close }} )<br>
<b>Profit/Loss:</b> {{ $pl }}<br>
<b>Pips:</b> {{ $pips }}')->
                help('Available vars: subscription_title, source_title, account, scope, ticket, type_str, symbol, lots, price, price_close, pl, pips, live_time, time_open, time_close, stoploss, takeprofit');
            $form->button('btn_closed','Test "Closed"')->on('click', $this->formatClick($form, 'closed'));

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');

            $form->saved(function (Form $form) {
                $form->model()->refreshWebHooks();
            });
        });
    }

    public function test(Request $request)
    {

        $info = $request->only('template', 'title');
        $rules = [
            'title' => 'required',
            'template' => 'required',
        ];
        $validator = Validator::make($info, $rules);
        if ($validator->fails()) {

            $data = array();
            foreach($validator->messages()->getMessages() as $key =>  $messages) {
                $data[] = $messages[0];
            }
            return response()->json(['status' => false, 'message' => implode("\r\n",$data)]);
        }

        $title = $request['title'];
        $template = $request['template'];

        $dummyOrder = ['source_title' => $title, 'subscription_title' => $title, 'ticket' => '1',
        'type_str' => 'BUY', 'symbol' => 'EURUSD', 'stoploss' => 10.1, 'takeprofit' => 11.1, 'pl' => 10,
        'pips' => 100, 'lots' => 0.1, 'scope' => 'test', 'account' => 11, 'price' => 11,
        'price_close' => 12, 'time' => '2000/10/10', 'time_close' => '2000/10/10'];

        try {
            $emailObject = OrderSignalEmail::create($title, $dummyOrder, $template);
            \Mail::to(Auth('admin')->user()->email)->send($emailObject);

        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }

        return response()->json(['status' => true, 'message' => 'successfully sent']);
    }

    private function formatClick($form, $type) {
        $path = $form->isCreating() ? $form->resource(-1) : $form->resource(-2);

        return "
        var form = $(this).closest('form');
        var title = form.find('input[name=\"title\"]').val();
        var template = form.find('textarea[name=\"template_signal_{$type}\"]').val();
        var token = form.find('input[name=\"_token\"]').val();

        $.ajax({
            url: \"{$path}/test\",
            type: \"POST\",
            data: {title : title, template : template, _token: token},
            success: function(response, newValue){
                if (response.status){
                    $.admin.toastr.success(response.message, '', {positionClass:\"toast-top-center\"});
                } else {
                    $.admin.toastr.error(response.message, '', {positionClass:\"toast-top-center\"});
                }
            }
        });
        ";
    }

}
