<?php

namespace App\Admin\Controllers;

use App\Models\Account;
use App\Models\AccountStatus;
use App\Models\CopierRiskType;
use App\Models\CopierSubscription;
use App\Models\CopierSubscriptionDestAccount;
use App\Models\CopierType;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Illuminate\Support\Facades\Request;

class MyStrategyController extends AdminController
{

    protected function title() {
        return trans('admin.my_strategies');
    }

    public function show($id, Content $content)
    {

        $accountNumber = CopierSubscriptionDestAccount::find($id)->account()->first()->account_number;

        return redirect("mytrades?&account_number=$accountNumber");
    }

    protected function grid()
    {
        return new Grid( new CopierSubscriptionDestAccount(), function (Grid $grid) {
            $grid->model()->whereHas('account', function ($q) {
                $q->where('user_id', Admin::user()->id);
            });

            $grid->disableExport();
            $grid->disableFilter();
            //$grid->disableCreateButton();
            //$grid->disableRowSelector();

            $grid->account()->account_number('Account');
            $grid->subscription()->title(__('admin.strategy'))->label();

            $grid->column('risk', 'Risk');

            $grid->account()->account_status('Status')->display(function ($status) {
                return AccountStatus::title($status);
            })->sortable();

            $grid->enabled()->switch()->sortable();

            $grid->actions(function ($actions) {
                //$actions->disableDelete();
            });

            $grid->rows(function (Grid\Row $row) {

                $val = '';
                switch ($row->risk_type) {
                    case CopierRiskType::MULTIPLIER :
                        $val = $row->lots_multiplier;
                        break;
                    case CopierRiskType::FIXED_LOT :
                        $val = $row->fixed_lot;
                        break;
                    case CopierRiskType::SCALING :
                        $val = $row->scaling_factor;
                        break;
                    case CopierRiskType::MONEY_RATIO :
                        $val = $row->money_ratio_lots.' per $'.$row->money_ratio_dol;
                        break;
                }

                $str = CopierRiskType::title($row->risk_type). ' ( '.$val.' )';

                $row->column('risk', $str);
            });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */

    protected function form($id = false)
    {
        return new Form( new CopierSubscriptionDestAccount(), function (Form $form) use($id) {
            $prefix = config('admin.route.prefix');

            if (!empty($prefix)) {
                $prefix = '/' . $prefix;
            }

            if ($form->isEditing()) {
            } else {
                //$user = User::find(Admin::user()->id);
                $subscriptions = CopierSubscription::whereManagerId(Admin::user()->manager_id)->pluck('title', 'id');
                $form->select('copier_subscription_id', __('admin.subscription'))->options($subscriptions)->required()
                    ->load('account_id', "$prefix/api/mycopiers/account");

                $options = Account::where([['user_id', Admin::user()->id]])->pluck('account_number', 'id');
                $form->select('account_id', 'Account')->options($options)->required();
            }

            $form->number('max_lots_per_trade', 'Max Lots Per Trade')->required()->default(1)->min(0.1);

            $options = [
                CopierRiskType::SCALING => CopierRiskType::title(CopierRiskType::SCALING),
                CopierRiskType::MULTIPLIER => CopierRiskType::title(CopierRiskType::MULTIPLIER),
                CopierRiskType::FIXED_LOT => CopierRiskType::title(CopierRiskType::FIXED_LOT),
                CopierRiskType::RISK_PERCENT => CopierRiskType::title(CopierRiskType::RISK_PERCENT),
                CopierRiskType::MONEY_RATIO => CopierRiskType::title(CopierRiskType::MONEY_RATIO),
            ];


            $s = CopierRiskType::SCALING; $m = CopierRiskType::MULTIPLIER; $f = CopierRiskType::FIXED_LOT;
            $r = CopierRiskType::RISK_PERCENT; $mr = CopierRiskType::MONEY_RATIO;
            if( $id )
                $risk = $form->model()->find($id)->risk_type;
            else
                $risk = CopierRiskType::SCALING;

            $script =  <<<EOT
            function toggle(risk) {
                switch (risk) {
                    case '$s':
                      $('.scaling').show();
                      break;
                  case '$m':
                      $('.multiplier').show();
                      break;
                  case '$f':
                      $('.fixed').show();
                      break;
                  case '$r':
                      $('.percent').show();
                      break;
                  case '$mr':
                      $('.ratio').show();
                      break;
                  }
            }

            $('.multiplier').hide();
            $('.fixed').hide();
            $('.scaling').hide();
            $('.percent').hide();
            $('.ratio').hide();
            toggle('$risk');

$('.risk_type').on('ifChecked', function(event){
    $('.multiplier').hide();
    $('.scaling').hide();
    $('.fixed').hide();
    $('.percent').hide();
    $('.ratio').hide();

    toggle($(this).val());

  });
EOT;

            $form->radio('risk_type', 'Risk Type')->
                values($options)->
                default($risk)->setScript($script);

            $form->number('scaling_factor', 'Scaling Factor')->default(1)->setGroupClass('scaling');
            $form->number('lots_multiplier', 'Lots Multiplier')->default(1)->setGroupClass('multiplier');
            $form->decimal('fixed_lot', 'Fixed Lot')->default(0.1)->setGroupClass('fixed');
            $form->number('max_risk', 'Risk (%)')->default(3)->setGroupClass('percent');
            $form->decimal('money_ratio_lots', 'Ratio Lots')->default(0.1)->setGroupClass('ratio');
            $form->decimal('money_ratio_dol', 'Ratio Dollars')->default(500)->setGroupClass('ratio');

            $form->switch('enabled', 'Enabled?');

            if ($form->isCreating()) {
                $form->switch('copy_existing', 'Copy Already Working Orders')->default(1);
                $form->ignore(['copy_existing']);
            }

            $form->disableCreatingCheck();
            $form->disableEditingCheck();
            $form->disableViewCheck();
            $form->disableReset();

            $form->saved(function (Form $form) {

                if(request()->exists('copy_existing')) {
                    $subscription = CopierSubscriptionDestAccount::find($form->model()->id);

                    if(request()->get('copy_existing') == 'off') {
                        $subscription->live_time = 180; // 3 mins
                    } else {
                        $subscription->live_time = 0; // copy all
                    }
                    $subscription->save();
                }
            });
        });
    }

    public function account(Request $request)
    {
        $userId = Admin::user()->id;
        $subscriptionId = Request::get('q');

        return Account
            ::where([
                ['user_id', $userId],
                ['copier_type', CopierType::SLAVE]
            ])
            ->whereDoesntHave('destinations', function ($query) use ($subscriptionId) {
                $query->where('copier_subscription_id', $subscriptionId);
            })
            ->selectRaw('id, account_number as text')->get();
    }
}