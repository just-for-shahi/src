<?php

namespace App\Admin\Controllers;

use App\Helpers\BladeHelper;
use App\Models\Account;

use App\Models\CopierType;
use App\Models\TelegramSubscription;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use NotificationChannels\Telegram\Telegram;
use NotificationChannels\Telegram\TelegramMessage;

class TelegramSubscriptionController extends AdminController
{
    protected function title() {
        return trans('admin.telegram_subscriptions');
    }

    protected function grid()
    {
        return new Grid(new TelegramSubscription(), function (Grid $grid) {
            $grid->model()->whereManager_id(Admin::user()->id);

            $grid->id('ID')->sortable();

            $grid->tag('Tag');
            $grid->title('Title');

            $grid->sources('Source Accounts')->pluck('account_number')->label();

            $grid->created_at()->sortable();
            $grid->updated_at();

            $grid->actions(function ($actions) {
                $actions->disableView();
            });

            $grid->disableExport();
            $grid->disableFilter();
        });
    }

    protected function form()
    {
        return new Form(new TelegramSubscription(), function (Form $form) {
            $form->hidden('manager_id')->value(Admin::user()->id);
            $form->text('tag', 'Tag');
            $form->text('title', 'Title')->required();
            $form->text('bot_api_token', 'Bot API Token')->required();
            $form->text('channel_id', 'Channel ID')->required();


            $form->multipleSelect('sources', 'Source Accounts')->options(
                Account::where([
                    ['manager_id', Admin::user()->id],
                    ['copier_type', CopierType::MASTER]
                    ])
                    ->selectRaw("CONCAT (`account_number`,
                    CASE WHEN title IS NULL THEN '' ELSE CONCAT(' (',`title`,')') END  ) AS acc_title, id")
                    ->pluck('acc_title', 'id')
            )->allowSelectAll()->required();

            $form->textarea('template_signal_new', 'Template order "New"')->
                default('*New Order!* ID:{{$ticket}}; Symbol:{{$symbol}}; Type: {{$type_str}}')->
                help('Available vars: subscription_title, source_title, account_number, ticket, type_str, symbol, price, lots, stoploss, takeprofit, time_open');
            $form->button('btn_new','Test "New"')->on('click', $this->formatClick($form, 'signal_new'));

            $form->textarea('template_signal_canceled', 'Template order "Canceled"')->
                default('*Order Canceled!* ID:{{$ticket}}; Symbol:{{$symbol}}; Type: {{$type_str}}')->
                help('Available vars: subscription_title, source_title, account_number, ticket, type_str, symbol, price, lots, time_open');
            $form->button('btn_canceled','Test "Canceled"')->on('click', $this->formatClick($form, 'signal_canceled'));

            $form->textarea('template_signal_updated', 'Template order "Modify"')->
                default('*Order Updated!* ID: {{$ticket}}; Symbol: {{$symbol}}; Type: {{$type_str}}; Stoploss: {{$stoploss}}, Takeprofit: {{$takeprofit}}')->
                help('Available vars: subscription_title, source_title, account, ticket, type_str, symbol, lots, price, stoploss, takeprofit, time_open');
            $form->button('btn_updated','Test "Updated"')->on('click', $this->formatClick($form, 'signal_updated'));

            $form->textarea('template_signal_closed_profit', 'Template order "Close Profit"')->
                default('*Order Closed with Profit!* ID: {{$ticket}}; Symbol: {{$symbol}}; Type: {{$type_str}}; PL: {{$pl}}; Pips: {{$pips}}')->
                help('Available vars: subscription_title, source_title, account, ticket, type_str, symbol, lots, price, price_close, pl, pips, live_time, time_open, time_close, stoploss, takeprofit');
            $form->button('btn_closed_profit','Test "Closed Profit"')->on('click', $this->formatClick($form, 'signal_closed_profit'));

            $form->textarea('template_signal_closed_lost', 'Template order "Close Lost"')->
                default('*Order Closed with Loss!* ID: {{$ticket}}; Symbol: {{$symbol}}; Type: {{$type_str}}; PL: {{$pl}} ; Pips: {{$pips}}')->
                help('Available vars: subscription_title, source_title, account, ticket, type_str, symbol, lots, price, price_close, pl, pips, live_time, time_open, time_close, stoploss, takeprofit');
            $form->button('btn_closed_lost','Test "Closed Lost"')->on('click', $this->formatClick($form, 'signal_closed_lost'));

            $form->textarea('template_signal_closed_breakeven', 'Template order "Close BreakEven"')->
                default('*Order Closed Breakeven!* ID: {{$ticket}}; Symbol: {{$symbol}}; Type: {{$type_str}};')->
                help('Available vars: subscription_title, source_title, account, ticket, type_str, symbol, lots, price, price_close, pl, pips, live_time, time_open, time_close, stoploss, takeprofit');
            $form->button('btn_closed_breakeven','Test "Closed Breakeven"')->on('click', $this->formatClick($form, 'signal_closed_breakeven'));

            $form->textarea('template_overview_week', 'Template order "Overview Week"')->
                default('🏦 Weekly Overview {{$subscription_title}}
Closed Orders: {{$closed_orders}}
Sell Orders: {{$sell_orders}}
Buy Orders: {{$buy_orders}}
Nett Pips: {{$net_pips}}
Account Growth: {{$growth_pct}}%')->
                help('Available vars: subscription_title, closed_orders, sell_ordes, buy_orders, net_pips, growth_pct');
            $form->button('btn_overview_week','Test "Overview Week"')->on('click', $this->formatClick($form, 'overview_week'));

            $form->textarea('template_overview_month', 'Template order "Overview Month"')->
                default('🏦 Monthly Overview {{$subscription_title}}
Closed Orders: {{$closed_orders}}
Sell Orders: {{$sell_orders}}
Buy Orders: {{$buy_orders}}
Nett Pips: {{$net_pips}}
Account Growth: {{$growth_pct}}%')->
                help('Available vars: subscription_title, closed_orders, sell_ordes, buy_orders, net_pips, growth_pct');
            $form->button('btn_overview_month','Test "Overview Month"')->on('click', $this->formatClick($form, 'overview_month'));

            $form->textarea('template_overview_quartal', 'Template order "Overview Quartal"')->
                default('🏦Quarterly Overview {{$subscription_title}}
Closed Orders: {{$closed_orders}}
Sell Orders: {{$sell_orders}}
Buy Orders: {{$buy_orders}}
Nett Pips: {{$net_pips}}
Account Growth: {{$growth_pct}}%')->
                help('Available vars: subscription_title, closed_orders, sell_ordes, buy_orders, net_pips, growth_pct');
            $form->button('btn_overview_quartal','Test "Overview Quartal"')->on('click', $this->formatClick($form, 'overview_quartal'));

            $form->textarea('template_overview_half_year', 'Template order "Overview Half-Annum"')->
                default('🏦Half-Annum Overview {{$subscription_title}}
Closed Orders: {{$closed_orders}}
Sell Orders: {{$sell_orders}}
Buy Orders: {{$buy_orders}}
Nett Pips: {{$net_pips}}
Account Growth: {{$growth_pct}}%')->
                help('Available vars: subscription_title, closed_orders, sell_ordes, buy_orders, net_pips, growth_pct');
            $form->button('btn_overview_half_year','Test "Overview Half-Annum"')->on('click', $this->formatClick($form, 'overview_half_year'));

            $form->textarea('template_overview_year', 'Template order "Overview Year"')->
                default('🏦Yearly Overview {{$subscription_title}}
Closed Orders: {{$closed_orders}}
Sell Orders: {{$sell_orders}}
Buy Orders: {{$buy_orders}}
Nett Pips: {{$net_pips}}
Account Growth: {{$growth_pct}}%')->
                help('Available vars: subscription_title, closed_orders, sell_ordes, buy_orders, net_pips, growth_pct');
            $form->button('btn_overview_year','Test "Overview Year"')->on('click', $this->formatClick($form, 'overview_year'));

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');

            $form->saved(function (Form $form) {
                $form->model()->refreshWebHooks();
            });
        });
    }

    public function test(Request $request)
    {

        $info = $request->only('bot_api_token', 'title', 'channel_id', 'template');
        $rules = [
            'bot_api_token' => 'required',
            'title' => 'required',
            'channel_id' => 'required',
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

        $botAPI_Token = $request['bot_api_token'];
        $title = $request['title'];
        $channelId = $request['channel_id'];
        $template = $request['template'];

        $dummyOrder = ['source_title' => $title,'subscription_title' => $title, 'ticket' => '1',
            'type_str' => 'BUY', 'symbol' => 'EURUSD','stoploss' => 10.1, 'takeprofit' => 11.1,
            'pl' => 10, 'pips' => 100, 'lots' => 0.1,'time_open' => '2020.05.21 12:00',
            'time_close' => '2020.05.21 12:00','account_number' => 11, 'price_close' => 1.1111, 'price' => 1.3455,
            'closed_orders' => 10, 'sell_orders' => 3,'buy_orders' => 7, 'net_pips' => 130, 'growth_pct' => 12
        ];

        try {
            $message = BladeHelper::bladeCompile( $template, $dummyOrder);

            $telegramMessage = TelegramMessage::create($message);
            $telegram = new Telegram($botAPI_Token);
            $telegramMessage = $telegramMessage->to($channelId)->toArray();
            $telegram->sendMessage($telegramMessage);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }

        return response()->json(['status' => true, 'message' => 'successfully sent']);
    }

    private function formatClick($form, $type) {
        $path = $form->isCreating() ? $form->resource(-1) : $form->resource(-2);

        return "
        var form = $(this).closest('form');
        var bot_api_token = form.find('input[name=\"bot_api_token\"]').val();
        var title = form.find('input[name=\"title\"]').val();
        var channel_id = form.find('input[name=\"channel_id\"]').val();
        var template = form.find('textarea[name=\"template_{$type}\"]').val();
        var token = form.find('input[name=\"_token\"]').val();

        $.ajax({
            url: \"{$path}/test\",
            type: \"POST\",
            data: {bot_api_token : bot_api_token, title : title, channel_id : channel_id,
                template : template, _token: token},
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

