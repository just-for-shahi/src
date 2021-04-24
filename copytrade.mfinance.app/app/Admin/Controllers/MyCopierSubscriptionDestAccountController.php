<?php

namespace App\Admin\Controllers;

use App\Models\Account;
use App\Models\AccountStatus;
use App\Models\CopierRiskType;
use App\Models\CopierSubscription;
use App\Models\CopierSubscriptionDestAccount;
use App\Models\CopierType;

use App\Models\FilterCondition;
use App\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;

class MyCopierSubscriptionDestAccountController extends AdminController
{

    protected function title() {
        return trans('admin.my_copiers');
    }

    protected function details($id)
    {
        return new Show(CopierSubscriptionDestAccount::findOrFail($id), function($show) {

            $show->max_lots_per_trade('Max Lots Per Trade');
            $show->scaling_factor('Scaling Factor');
            $show->lots_multiplier('Multiplier');
            $show->fixed_lot('Fixed Lot');
            $show->money_ratio_lots('Ratio Lots');
            $show->money_ratio_dol('Ratio Dollars');

            $show->enabled('Trade Allowed?')->as(function ($val) {
                return $val == 1 ? 'Yes' : 'No';
            });

            $show->created_at('Created');
            $show->updated_at('Updated');
        });
    }

    protected function grid()
    {
        return new Grid( new CopierSubscriptionDestAccount(), function (Grid $grid) {
            $grid->model()->whereHas('account', function ($q) {
                $q->where('user_id', Auth('admin')->user()->id);
            });

            $grid->disableExport();

            $grid->account()->account_number('Account');
            $grid->account()->broker_server_name('Broker');
            $grid->subscription()->title(__('admin.subscription'))->label();

            $grid->risk_type('Risk Type')->display(function ($risk) {
                return CopierRiskType::title($risk);
            });

            if(Str::contains(config('copier.aval_risk_types'), CopierRiskType::SCALING ) )
                $grid->scaling_factor('Scaling Factor')->editable()
                    ->display(function ($val) {
                        if ($this->risk_type != CopierRiskType::SCALING) {
                            return '';
                        }

                        return $val;
                    });

            if(Str::contains(config('copier.aval_risk_types'), CopierRiskType::MULTIPLIER ) )
                $grid->lots_multiplier('Multiplier')->editable()
                    ->display(function ($val) {
                        if ($this->risk_type != CopierRiskType::MULTIPLIER) {
                            return '';
                        }

                        return $val;
                    });

            if(Str::contains(config('copier.aval_risk_types'), CopierRiskType::FIXED_LOT ) )
                $grid->fixed_lot('Fixed Lots')->editable()
                ->display(function ($val) {
                    if ($this->risk_type != CopierRiskType::FIXED_LOT) {
                        return '';
                    }

                    return $val;
                });


            if(Str::contains(config('copier.aval_risk_types'), CopierRiskType::RISK_PERCENT ) )
                $grid->max_risk('Risk (%)')->editable()
                ->display(function ($val) {
                    if ($this->risk_type != CopierRiskType::RISK_PERCENT) {
                        return '';
                    }

                    return $val;
                });

            $grid->account()->account_status('Status')->display(function ($status) {
                return AccountStatus::title($status);
            })->sortable();

            $grid->enabled()->switch()->sortable();

            $grid->filter(function ($filter) {
                $filter->like('account.account_number', 'Account');
                $filter->disableIdFilter();
            });
            $grid->actions(function ($actions) {
                $actions->disableView();
            });

            $grid->rows(function (Grid\Row $row) {
            });
        });
    }

    public function edit($id, Content $content)
    {
        return $content
            ->title($this->title())
            ->description($this->description['edit'] ?? trans('admin.edit'))
            ->body($this->form($id)->edit($id));
    }

    protected function form($id = false)
    {
        return new Form( new CopierSubscriptionDestAccount(), function (Form $form) use($id) {
            $prefix = config('admin.route.prefix');

            if (!empty($prefix)) {
                $prefix = '/' . $prefix;
            }

            if ($form->isEditing()) {
            } else {
                $user = User::find(Admin::user()->id);
                $subscriptions = $user->copiersubscriptions()->pluck('title', 'copier_subscriptions.id');
                $subscriptionsPublic = CopierSubscription::
                    whereManagerId(Admin::user()->manager_id)->
                    where('is_public', 1)->
                    pluck('title', 'id');

                $subscriptions = $subscriptions->toArray() + $subscriptionsPublic->toArray();
                $form->select('copier_subscription_id', __('admin.subscription'))->options($subscriptions)->required()
                    ->load('account_id', "$prefix/api/mycopiers/account");

                $options = Account::where([['user_id', Admin::user()->id]])->pluck('account_number', 'id');
                $form->select('account_id', 'Account')->required(); //->options($options)->required();
            }
            $form->number('max_lots_per_trade', 'Max Lots Per Trade')->min(0.01)->required()->default(1);

            $tOptions = [
                CopierRiskType::SCALING => CopierRiskType::title(CopierRiskType::SCALING),
                CopierRiskType::MULTIPLIER => CopierRiskType::title(CopierRiskType::MULTIPLIER),
                CopierRiskType::FIXED_LOT => CopierRiskType::title(CopierRiskType::FIXED_LOT),
                CopierRiskType::RISK_PERCENT => CopierRiskType::title(CopierRiskType::RISK_PERCENT),
                CopierRiskType::MONEY_RATIO => CopierRiskType::title(CopierRiskType::MONEY_RATIO),
            ];

            $options = array();
            foreach($tOptions as $key => $value) {
                if(Str::contains(config('copier.aval_risk_types'), $key))
                    $options[$key] = $value;
            }

            $s = CopierRiskType::SCALING; $m = CopierRiskType::MULTIPLIER; $f = CopierRiskType::FIXED_LOT;
            $r = CopierRiskType::RISK_PERCENT; $mr = CopierRiskType::MONEY_RATIO;
            if( $id )
                $risk = $form->model()->find($id)->risk_type;
            else
                $risk = array_key_first($options);

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
            $('.scaling').hide();
            $('.fixed').hide();
            $('.scaling').hide();
            $('.percent').hide();
            $('.ratio').hide();
            toggle('$risk');

$('.risk_type').on('ifChecked', function(event){
    $('.multiplier').hide();
    $('.scaling').hide();
    $('.fixed').hide();
    $('.scaling').hide();
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
            $form->number('fixed_lot', 'Fixed Lot')->default(0.1)->setGroupClass('fixed')->min(0.01)->default(0.1);
            $form->number('max_risk', 'Risk (%)')->default(3)->setGroupClass('percent')->min(0.1);
            $form->number('money_ratio_lots', 'Ratio Lots')->default(0.1)->setGroupClass('ratio')->min(0.01);
            $form->number('money_ratio_dol', 'Ratio Dollars')->default(500)->setGroupClass('ratio')->min(1);

            $form->switch('enabled', 'Enabled?');

            if(config('copier.has_adv_filters')) {
                $conditions = FilterCondition::all();

                $form->select('filter_symbol_condition', 'Filter Symbol Condition')->options($conditions);
                $form->text('filter_symbol_values', 'Filter Symbol Values');

                $form->select('filter_magic_condition', 'Filter Magic Condition')->options($conditions);
                $form->text('filter_magic_values', 'Filter Magic Values');

                // $form->select('filter_comment_condition', 'Filter Comment Condition')->options($conditions);
                // $form->text('filter_comment_values', 'Filter Comment Values');
            }

            $form->number('price_diff_accepted_pips', 'Price Diff')->default(50)->help('If price difference is more than Price Diff, order will be ignored. Works for account which connected when Sender has open orders.');
            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');

            $form->saved(function (Form $form) {
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