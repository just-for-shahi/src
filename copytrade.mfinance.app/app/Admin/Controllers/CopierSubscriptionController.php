<?php

namespace App\Admin\Controllers;

use App\Models\Account;
use App\Models\CopierRiskType;
use App\Models\CopierSubscription;

use App\Models\CopierType;
use App\Models\FilterCondition;
use App\Models\ManagerSetting;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Grid\Column\Filter;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Support\Str;

class CopierSubscriptionController extends AdminController
{

    protected function title()
    {
        return trans('admin.copier_subscription');
    }

    protected function detail($id)
    {
        $show = new Show(CopierSubscription::findOrFail($id));

        $show->lots_multiplier('Multiplier');
        $show->fixed_lot('Fixed Lot');
        $show->money_ratio_lots('Ratio Lots');
        $show->money_ratio_dol('Ratio Dollars');

        $show->enabled('Trade Allowed?')->as(function ($val) {
            return $val == 1 ? 'Yes' : 'No';
        });

        $show->created_at('Created');
        $show->updated_at('Updated');

        return $show;
    }

    protected function grid()
    {
        return new Grid(new CopierSubscription(), function (Grid $grid) {
            $grid->model()->whereManagerId(Admin::user()->id);

            $grid->id('ID');

            $grid->scope_key('Key');
            $grid->title('Title')->sortable()->editable();
            $grid->sources('Sender Accounts')->pluck('account_number')->label();
            //$grid->min_balance('Min Balance')->editable();

            $grid->risk_type('Risk Type')->display(function ($risk) {
                return CopierRiskType::title_short($risk);
            });

            $grid->scaling_factor('Scaling Factor')
                ->display(function ($val) {
                    if ($this->risk_type != CopierRiskType::SCALING) {
                        return '';
                    }

                    return $val;
                });

            $grid->lots_multiplier('Multiplier')
                ->display(function ($val) {
                    if ($this->risk_type != CopierRiskType::MULTIPLIER) {
                        return '';
                    }

                    return $val;
                });
            $grid->fixed_lot('Fixed Lots')
                ->display(function ($val) {
                    if ($this->risk_type != CopierRiskType::FIXED_LOT) {
                        return '';
                    }

                    return $val;
                });
            $grid->max_risk('Risk (%)')
            ->display(function ($val) {
                if ($this->risk_type != CopierRiskType::RISK_PERCENT) {
                    return '';
                }

                return $val;
            });

            $grid->actions(function ($actions) {
                $actions->disableView();
            });

            $grid->is_public()->switch()->sortable();
            $grid->created_at();
            $grid->updated_at();

            $grid->hideColumns(['created_at', 'updated_at']);

            $mSettings = ManagerSetting::getCurrent();

            if($mSettings && !$mSettings->canHaveCopiers()) {
                $grid->disableCreateButton();
            }

            $grid->filter(function ($filter) {
                $filter->like('title');
                $filter->equal('sources.account_id', 'Sender Account')->select(
                    Account::whereManagerId(Admin::user()->id)->where('copier_type', CopierType::MASTER)->pluck('account_number', 'id')
                );
                $filter->disableIdFilter();
            });

        });
    }

    protected function form($id = false)
    {
        return new Form(new CopierSubscription(), function (Form $form) use($id) {
            $form->hidden('manager_id')->value(Admin::user()->id);
            $form->hidden('creator_id')->value(Admin::user()->id);

            if ($form->isEditing()) {
                $form->text('scope_key', 'Key')->disable();
            } else {
                $form->text('scope_key', 'Key')->creationRules(['required', "unique:copier_subscriptions"]);
            }

            $form->text('title', 'Title')->required();

            $form->multipleSelect('sources', 'Sender Accounts')->options(
                Account::where([
                    ['manager_id', Admin::user()->id],
                    ['copier_type', CopierType::MASTER]
                ])
                    ->selectRaw("CONCAT (`account_number`,
                    CASE WHEN title IS NULL THEN '' ELSE CONCAT(' (',`title`,')') END  ) AS acc_title, id")
                    ->pluck('acc_title', 'id')
            )->required()
            ->help('To add Sender Accounts, go to <a href="/accounts">Accounts Page</a>');

            $form->number('min_balance', 'Min Balance')->default(1);
            $form->number('max_lots_per_trade', 'Max Lots Per Trade')->min(0.01)->required()->default(1);

            $options = [
                CopierRiskType::SCALING => CopierRiskType::title(CopierRiskType::SCALING),
                CopierRiskType::MULTIPLIER => CopierRiskType::title(CopierRiskType::MULTIPLIER),
                CopierRiskType::FIXED_LOT => CopierRiskType::title(CopierRiskType::FIXED_LOT),
                CopierRiskType::RISK_PERCENT => CopierRiskType::title(CopierRiskType::RISK_PERCENT),
                CopierRiskType::MONEY_RATIO => CopierRiskType::title(CopierRiskType::MONEY_RATIO),
            ];

            $s = CopierRiskType::SCALING; $m = CopierRiskType::MULTIPLIER; $f = CopierRiskType::FIXED_LOT;
            $r = CopierRiskType::RISK_PERCENT; $mr = CopierRiskType::MONEY_RATIO;
            if( $id ) {
                $risk = $form->model()->find($id)->risk_type;
            } else
                $risk = CopierRiskType::MULTIPLIER;

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
            $form->decimal('fixed_lot', 'Fixed Lot')->default(0.1)->setGroupClass('fixed');
            $form->number('max_risk', 'Risk (%)')->default(3)->setGroupClass('percent');
            $form->decimal('money_ratio_lots', 'Ratio Lots')->default(0.1)->setGroupClass('ratio');
            $form->decimal('money_ratio_dol', 'Ratio Dollars')->default(500)->setGroupClass('ratio');

            $form->textarea('pairs_matching', 'Pairs Matching')->help('Format is <b>GOLD=AUUSD;SILVER=AGUSD;</b>');

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
            $form->switch('is_public', 'Public?')->default(0);
            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');

            $form->saving(static function ($form) {
                if ( !$form->isEditing() && empty($form->scope_key)) {
                    $form->scope_key = Str::slug($form->title, '-');
                }
            });
        });
    }
}
