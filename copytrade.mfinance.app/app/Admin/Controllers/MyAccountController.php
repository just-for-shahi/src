<?php

namespace App\Admin\Controllers;

use App\Jobs\ProcessPendingAccount;
use App\Jobs\ProcessRemovedAccount;
use App\Models\Account;
use App\Models\AccountStatus;
use App\Models\ApiServer;
use App\Models\CopierSubscription;
use App\Models\CopierSubscriptionDestAccount;

use App\Models\UserBrokerServer;
use App\Models\UserSubscriptionSetting;
use App\Models\WsHost;
use App\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;


class MyAccountController extends AdminController
{
    protected function title() {
        return trans('admin.my_accounts');
    }

    public function index(Content $content)
    {
        return $content
            ->title($this->title())
            ->description(trans('admin.my_accounts_list'))
            ->body($this->grid());
    }

    protected function details($id)
    {
        $show = new Show(Account::findOrFail($id));

        $show->account_number('Account Number');
        $show->name('Account Name');
        $show->broker_server_name('Broker Server');
        $show->is_live('Live or Demo')->as(function ($val) {
            return $val == 1 ? 'Live' : 'Demo';
        });
        $show->trade_allowed('Trade Allowed?')->as(function ($val) {
            return $val == 1 ? 'Yes' : 'No';
        });
        $show->account_status('Status')->as(function ($status) {
            return AccountStatus::title($status);
        });
        $show->currency('Currency');
        $show->Company('Broker Company');
        $show->created_at('Created');
        $show->updated_at('Updated');

        return $show;
    }

    protected function grid()
    {
        return new Grid(new Account(), function (Grid $grid) {
            $grid->id('ID');
            $grid->model()->where('user_id', Auth('admin')->user()->id);

            $grid->account_number('Account');
            //$grid->stat()->name('Name');
            $grid->broker_server_name('Server');
            $grid->destinations('Strategy')->pluck('title')->label();
            $grid->stat()->balance('Balance');
            $grid->stat()->equity('Equity');
            $grid->stat()->profit('P/L');
            //$grid->stat()->drawdown_perc('Drawdown');
            $grid->account_status('Status')->display(function ($status) {
                return AccountStatus::title($status);
            })->sortable();

            // $grid->created_at()->sortable();
            // $grid->updated_at();

            $grid->filter(function ($filter) {
                $filter->like('account_number');
                $filter->disableIdFilter();
            });

            $grid->tools(function ($tools) {
                $tools->disableRefreshButton();
            });

            $user = Auth('admin')->user();
            $s = UserSubscriptionSetting::whereUserId($user->id)->first();
            $cntAccounts = Account::whereUserId($user->id)->count();
            if ( $s && $s->max_accounts > 0 && $cntAccounts >= $s->max_accounts)
                $grid->disableCreateButton();

            $grid->actions(function ($actions) {
                $actions->disableView();
            });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return new Form(new Account(), function (Form $form) {
            $u = Auth('admin')->user();

            $form->hidden('user_id')->value($u->id);
            $form->hidden('creator_id')->value($u->id);
            $form->hidden('manager_id')->value($u->manager_id);

            $form->hidden('api_server_ip')->value(
                ApiServer::whereManagerId($u->manager_id)->enabled()->first()->ip
            );

            $wsHost = WsHost::whereManagerId($u->manager_id)->first();
            if($wsHost) {
                $wsHost = $wsHost->host;
            } else {
                $wsHost = '';
            }
            $form->hidden('ws_host')->value(
                $wsHost
            );

            if ($form->isEditing()) {
                $form->text('account_number', 'Account Number')->disable();
            } else {
                $form->text('account_number', 'Account Number')
                ->creationRules(['required', "unique:accounts"]);
            }

            if ($u->can('user.direct_copier')) {
                $pwd = $form->text('password', 'Password');
                if ($u->can('user.ea_copier') == false) {
                    $pwd->required();
                } else {
                    $pwd->help('Leave empty if you are going to use <a href="/text.exe>Slave Expert Advisor</a>"');
                }
            }

            $options = UserBrokerServer
                ::with('broker_server')
                ->enabled()
                ->whereHas('broker_server', static function ($server) {
                    $server->api();
                })
                ->whereUserId($u->manager_id)->get();
            $arr = array();
            foreach ($options as $option) {
                $arr[$option->broker_server->name] = $option->broker_server->name;
            }
            $form->select('broker_server_name', 'Broker Server')->options($arr)->required();

            $user = User::find($u->id);
            $subscriptions = $user->copiersubscriptions()->pluck('title', 'copier_subscriptions.id');
            $subscriptionsPublic = CopierSubscription::
                whereManagerId(Admin::user()->manager_id)->
                where('is_public', 1)->
                pluck('title', 'id');

            $subscriptions = $subscriptions->toArray() + $subscriptionsPublic->toArray();

            $def = null;
            if (count($subscriptions) > 0) {
                $def = array_key_first($subscriptions);
            }

            $settings = UserSubscriptionSetting::whereUserId($u->id)->first();
            $maxSubscriptions = 0;
            if ($settings)
                $maxSubscriptions = $settings->max_copier_subscriptions;

            //$form->multipleSelect('destinations', __('admin.subscription'))->options($subscriptions)->default($def)->required()->config('maximumSelectionLength', $maxSubscriptions);
            $form->multipleSelect('destinations', __('admin.subscription'))->options($subscriptions)->config('maximumSelectionLength', $maxSubscriptions);

            $form->switch('copy_existing', 'Copy Already Working Orders')->default(1);
            $form->ignore(['copy_existing']);

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');

            $form->saved(function (Form $form) {

                $account = Account::find($form->model()->id);

                $account->account_status = AccountStatus::PENDING;
                $account->processing = true;
                $account->save();

                ProcessPendingAccount::dispatch($account->id)->onQueue($account->getConnectingQueueName());

                $subscriptions = CopierSubscriptionDestAccount::where('account_id', $form->model()->id)->get();

                foreach ($subscriptions as $subscription) {
                    $preset = CopierSubscription::find($subscription->copier_subscription_id);

                    if(!$preset)
                        continue;

                    if(request()->get('copy_existing') == 'off') {
                        $subscription->live_time = 180; // 3 mins
                    }

                    $subscription->fixed_lot = $preset->fixed_lot;
                    $subscription->lots_multiplier = $preset->lots_multiplier;
                    $subscription->max_risk = $preset->max_risk;
                    $subscription->risk_type = $preset->risk_type;
                    $subscription->money_ratio_lots = $preset->money_ratio_lots;
                    $subscription->scaling_factor = $preset->scaling_factor;
                    $subscription->money_ratio_dol = $preset->money_ratio_dol;
                    $subscription->min_balance = $preset->min_balance;
                    $subscription->max_lots_per_trade = $preset->max_lots_per_trade;

                    $subscription->save();
                }
            });

            $form->deleting(function (Form $form, $ids) {
                collect(explode(',', $ids))->filter()->each(function ($id) {
                    $account = Account::find($id);
                    $account->account_status = AccountStatus::REMOVING;
                    $account->save();

                    ProcessRemovedAccount::dispatch($id)->onQueue($account->getRemovingQueueName());
                });
                $response = [
                    'status'  => true,
                    'message' => trans('admin.delete_succeeded'),
                ];
                return response()->json($response);
            });

            $form->tools(function (Form\Tools $tools) {
                $tools->disableView();
            });
            $form->disableCreatingCheck();
            $form->disableEditingCheck();
            $form->disableViewCheck();
            $form->disableReset();
        });
    }
}
