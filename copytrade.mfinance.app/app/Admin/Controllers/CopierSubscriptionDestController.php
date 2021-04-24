<?php

namespace App\Admin\Controllers;

use App\User;
use App\Models\CopierSubscriptionDestAccount;
use App\Models\FilterCondition;
use App\Models\Account;
use App\Models\AccountStatus;
use App\Models\CopierType;
use App\Models\CopierSubscription;
use App\Models\CopierRiskType;

use App\Admin\Extensions\Tools\AddCopierSubscriptionDestAccountButton;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;
use Encore\Admin\Controllers\HasResourceActions;

class CopierSubscriptionDestController extends Controller
{

    use HasResourceActions;

    protected function show($id)
    {
        $show = new Show(CopierSubscriptionDestAccount::findOrFail($id));

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


    public $copierSubscriptionId;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return new Content(function (Content $content) {
            $content->header('Copiers');
            $content->description('Manage Copiers');

            $content->body($this->prepare());
        });
    }

    private function prepare()
    {
        $this->copierSubscriptionId = Request::get('copier_subscription_id');
        $copiers = array();

        $subscriptions = CopierSubscription::whereManagerId(User::GetManagerId())->get();

        foreach ($subscriptions as $subscription) {
            $copier['title'] = $subscription->title;
            $copier['link'] = url()->current() . '?copier_subscription_id=' . $subscription->id;

            if (empty($this->copierSubscriptionId) || $this->copierSubscriptionId == 0) {
                $this->copierSubscriptionId = $subscription->id;
                $copier['active'] = true;
            } else {
                $copier['active'] = $this->copierSubscriptionId == $subscription->id;
            }

            $copiers[] = $copier;
        }

        $vars = [
            'copiers'       => $copiers,
            'panel'          => $this->grid(),
        ];

        return view('admin.copier', $vars);
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return new Content(function (Content $content) use ($id) {
            $content->header('Copier');
            $content->description('Edit Copier');

            $content->body($this->form($id)->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return new Content(function (Content $content) {
            $this->copierSubscriptionId = Request::get('copier_subscription_id');

            $content->header('Copier');
            $content->description('New Copier');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return new Grid(new CopierSubscriptionDestAccount(), function (Grid $grid) {
            $grid->model()->where([
                ['copier_subscription_id', $this->copierSubscriptionId]
            ]);

            $grid->disableCreateButton();

            $grid->account()->account_number('Account');
            $grid->account()->broker_server_name('Broker');
            $grid->column('user.name', 'User Name');

            $grid->risk_type('Risk Type')->select([
                CopierRiskType::SCALING => CopierRiskType::title_short(CopierRiskType::SCALING),
                CopierRiskType::MULTIPLIER => CopierRiskType::title_short(CopierRiskType::MULTIPLIER),
                CopierRiskType::FIXED_LOT => CopierRiskType::title_short(CopierRiskType::FIXED_LOT),
                CopierRiskType::RISK_PERCENT => CopierRiskType::title_short(CopierRiskType::RISK_PERCENT),
                CopierRiskType::MONEY_RATIO => CopierRiskType::title_short(CopierRiskType::MONEY_RATIO)
            ]);

            $grid->scaling_factor('Scaling Factor')->editable()
                ->display(function ($val) {
                    if ($this->risk_type != CopierRiskType::SCALING) {
                        return '';
                    }

                    return $val;
                });
            $grid->lots_multiplier('Multiplier')->editable()
                ->display(function ($val) {
                    if ($this->risk_type != CopierRiskType::MULTIPLIER) {
                        return '';
                    }

                    return $val;
                });

            $grid->fixed_lot('Fixed Lots')->editable()
            ->display(function ($val) {
                if ($this->risk_type != CopierRiskType::FIXED_LOT) {
                    return '';
                }

                return $val;
            });

            $grid->max_risk('Risk(%)')->editable()
            ->display(function ($val) {
                if ($this->risk_type != CopierRiskType::RISK_PERCENT) {
                    return '';
                }

                return $val;
            });

            $grid->account()->account_status('Status')->display(function ($status) {
                return AccountStatus::title($status);
            });

            $grid->enabled()->switch()->sortable();

            $grid->filter(function ($filter) {
                $filter->like('account.account_number', 'Account');
                //$filter->like('account.broker_server.name', 'Broker');
                $filter->disableIdFilter();
            });
            $grid->actions(function ($actions) {
                $actions->disableView();
            });

            $grid->tools(function ($tools) {
                $tools->append(new AddCopierSubscriptionDestAccountButton($this->copierSubscriptionId));
            });

            $grid->rows(function (Grid\Row $row) {

                //var_dump()
            });
        });
    }

    private function form($id = false)
    {
        return new Form(new CopierSubscriptionDestAccount(), function (Form $form) use ($id) {
            $form->hidden('copier_subscription_id')->value($this->copierSubscriptionId);

            if ($id) {
                $s = CopierSubscriptionDestAccount::find($id)->subscription()->first();
                $form->html($s->title, __('admin.subscription'));
            } else {
                if ($this->copierSubscriptionId) {
                    $form->html(CopierSubscription::find($this->copierSubscriptionId)->title, __('admin.subscription'));
                }
            }

            $form->select('account_id', 'Follower Account')->options(
                Account
                    ::where([
                        ['manager_id', User::GetManagerId()],
                        ['copier_type', CopierType::SLAVE]
                    ])
                    ->whereDoesntHave('destinations', function ($query) {
                        $query->where('copier_subscription_id', $this->copierSubscriptionId);
                    })
                    ->pluck('account_number', 'id')
            )->required()
                ->help('To add Follower Accounts, go to <a href="/accounts">Accounts Page</a>');
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
            $form->decimal('fixed_lot', 'Fixed Lot')->default(0.1)->setGroupClass('fixed');
            $form->number('max_risk', 'Risk (%)')->default(3)->setGroupClass('percent');
            $form->decimal('money_ratio_lots', 'Ratio Lots')->default(0.1)->setGroupClass('ratio');
            $form->decimal('money_ratio_dol', 'Ratio Dollars')->default(500)->setGroupClass('ratio');

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

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');

            $form->saving(function (Form $form) {
                //var_dump($form);
                //exit();
            });
        });
    }
}
