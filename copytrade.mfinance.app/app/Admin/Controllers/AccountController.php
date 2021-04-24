<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\Tools\AccountMoveBatchAction;
use App\Admin\Extensions\Tools\AccountStatusBatchAction;
use App\Admin\Extensions\Tools\AccountStatusGridExt;
use App\Admin\Extensions\Tools\AddToCopierSubscriptionDestAction;
use App\Admin\Extensions\Tools\AddToCopierSubscriptionDestGridExt;
use App\Admin\Extensions\Tools\ApiServerGridExt;
use App\Admin\Extensions\Tools\OrderCloseBatchAction;
use App\Jobs\ProcessPendingAccount;
use App\Jobs\ProcessRemovedAccount;
use App\Models\Account;
use App\Models\AccountStatus;
use App\Models\ApiServer;

use App\Models\CopierSubscription;
use App\Models\CopierSubscriptionDestAccount;
use App\Models\CopierSubscriptionSourceAccount;
use App\Models\CopierType;
use App\Models\ManagerSetting;
use App\Models\OrderStatus;
use App\Models\UserBrokerServer;
use App\Models\WsHost;
use App\User;
use Carbon\Carbon;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class AccountController extends AdminController
{

    protected function title() {
        return trans('admin.accounts');
    }

    protected function detail($id)
    {
        $show = new Show(Account::findOrFail($id));

        $show->account_number('Account Number');
        $show->name('Account Name');
        $show->title('Title');
        $show->broker_server_name('Broker Server');
        //$show->is_live('Live or Demo')->as(function ($val) {
          //  return $val == 1 ? 'Live' : 'Demo';
        //});
        $show->trade_allowed('Trade Allowed?')->as(function ($val) {
            return $val == 1 ? 'Yes' : 'No';
        });

        $show->symbol_trade_allowed('Has suffix?')->as(function ($val) {
            return $val == 0 ? 'Yes' : 'No';
        });
        $show->api_server_ip('API Server');
        $show->copier_type('Type')->as(function ($type) {
            return CopierType::title($type);
        });
        $show->account_status('Status')->as(function ($status) {
            return AccountStatus::title($status);
        });
        $show->last_error('Last Error');
        $show->currency('Currency');
        $show->api_version('API Version');
        $show->Company('Broker Company');
        $show->created_at('Created');
        $show->updated_at('Updated');

        $show->liveorders('Live Orders', function ($order) use($show) {
            $order->resource('/orders');

            $order->disableExport();
            $order->disableActions();
            $order->disableFilter();
            $order->disableCreateButton();

            $order->symbol('Symbol');
            $order->type_str('Type')->sortable();
            $order->lots('Lots');
            $order->price('Price');
            $order->stoploss('Stoploss');
            $order->takeprofit('TakPprofit');
            $order->time_open('Time');
            $order->magic('Magic');
            $order->comment('Comment');

            $order->tools(function ($tools) use($show) {

                $tools->batch(function (Grid\Tools\BatchActions $batch) use($show) {
                    $batch->add('Close', new OrderCloseBatchAction($show->getModel()->account_number));
                });
            });

        });

        $show->closedorders('Closed Orders', function ($order) {
            $order->resource('/orders');

            $order->disableExport();
            $order->disableActions();
            $order->disableFilter();
            $order->disableCreateButton();

            $order->symbol('Symbol');
            $order->type_str('Type')->sortable();
            $order->lots('Lots');
            $order->price('Price');
            $order->stoploss('Stoploss');
            $order->takeprofit('TakPprofit');
            $order->time_open('Time');
            $order->time_close('Time');
            $order->price_close('Price');
            $order->pl('P/L');
            $order->pips('Pips');
            $order->magic('Magic');
            $order->comment('Comment');
        });

        return $show;
    }

    protected function grid()
    {
        return new Grid( new Account(), function (Grid $grid) {
            $grid->id('ID');

            $req_status = Request::get('account_status');
            if ($req_status == '' || $req_status == 'all') {
                $req_status = -1;
            }

            $api_server_ip = Request::get('api_server_ip');

            switch ($req_status) {
                case -1:
                    $status = array(
                        AccountStatus::NONE, AccountStatus::ONLINE, AccountStatus::OFFLINE,
                        AccountStatus::PENDING, AccountStatus::SUSPEND, AccountStatus::REMOVING,
                        AccountStatus::INVALID, AccountStatus::SUSPEND_STOPPED, AccountStatus::INVALID_STOPPED,
                        AccountStatus::VERIFYING, AccountStatus::RESETTING, AccountStatus::CNN_LOST
                    );
                    break;
                case AccountStatus::ONLINE:
                    $status = array(AccountStatus::ONLINE);
                    break;
                case AccountStatus::OFFLINE:
                    $status = array(AccountStatus::OFFLINE, AccountStatus::SUSPEND, AccountStatus::SUSPEND_STOPPED);
                    break;
                case AccountStatus::INVALID:
                    $status = array(AccountStatus::INVALID, AccountStatus::INVALID_STOPPED);
                    break;
                case AccountStatus::PENDING:
                    $status = array(AccountStatus::PENDING, AccountStatus::NONE, AccountStatus::REMOVING, AccountStatus::VERIFYING, AccountStatus::RESETTING, AccountStatus::CNN_LOST);
                    break;
            }
            $model = $grid->model()
                ->whereIn('account_status', $status)
                ->whereManagerId(User::GetManagerId());

            if (!empty($api_server_ip)) {
                $model->where('api_server_ip', $api_server_ip);
            }

            $grid->account_number('Account')->display(function($account) {
                return '<div style="white-space: nowrap;">'.$account. ' ( '.
                '<a title="Open Orders" href="/orders?account_number='.$account.'&status='.OrderStatus::OPEN.'">O</a>'
                .' | '.
                '<a title="Closed Orders" href="/orders?account_number='.$account.'&status='.OrderStatus::CLOSED.'">C</a>'
                .' | '.
                '<a title="Not Filled Orders" href="/orders?account_number='.$account.'&status='.OrderStatus::NOT_FILLED.'">NF</a>'.
                ' )</div>';
            });
            $grid->stat()->name('Name');
            $grid->title('Title');
            $grid->user()->name('User');
            $grid->user()->email('Email');
            //            $grid->api_server()->title('API')->sortable();
            $grid->broker_server_name('Broker')->sortable()->display(function ($name) {
                return '<a href="/accounts?broker_server_name='.$name.'">'.$name.'</a>';
            });

            $grid->api_server_ip('VPS')->sortable()->display(function ($ip) {
                return '<a href="/accounts?api_server_ip='.$ip.'">'.$ip.'</a>';
            });

            if (Admin::user()->can('mng.copiers')) {
                $grid->column('source_destinations', 'Copiers');
            }

            $grid->sources('S')->pluck('title');
            $grid->destinations('D')->pluck('title');
            $grid->trade_allowed('Trade?');

            if (Admin::user()->can('mng.copiers')) {
                $grid->copier_type('Type')->display(function ($type) {
                    //return '<a href="/accounts?copier_type='.$type.'">'.CopierType::title($type).'</a>';
                    return CopierType::title($type);
                });
            }
            $grid->account_status('Status')->display(function ($status) {
                return AccountStatus::title($status);
            })->sortable();

            $grid->stat()->balance('Balance');
            $grid->column('bst','B/S/T')->help('Buys/Sells/Total');

            if($req_status == AccountStatus::INVALID) {
                $grid->last_error('Last Error');
            } else {
                if (Admin::user()->can('mng.orders')) {
                    $grid->column('ViewOrders');
                }
            }

            $grid->updated_at('Updated')->display(function ($updated_at) {
                return Carbon::parse($updated_at)->diffForHumans();
            });

            $grid->api_version('Ver#');

            $grid->rows(function (Grid\Row $row) {

                //var_dump($row->trade_allowed);

                $items = array();
                if ($row->copier_type == CopierType::title(CopierType::SLAVE)) {
                    if($row->trade_allowed == '0') {
                        $t = '<span class="label label-danger">' . $row->copier_type.'(investor password)' . '</span> ';
                        $row->column('copier_type', $t);
                        //echo $row->copier_type;
                        //exit();
                    }
                    $items = $row->destinations;
                } else {
                    $items = $row->sources;
                }

                $data = '';
                foreach ($items as $item) {
                    $data .= '<span class="label label-success">' . $item . '</span> ';
                }

                $row->column('source_destinations', $data);

                $row->column(
                    'ViewOrders',
                    "<a href='orders?account_number={$row->account_number}&status=" . OrderStatus::NOT_FILLED . "'>Error</a> | " .
                        "<a href='orders?account_number={$row->account_number}&status=" . OrderStatus::OPEN . "'>Open</a> | " .
                        "<a href='orders?account_number={$row->account_number}&status=" . OrderStatus::CLOSED . "'>Closed</a>"
                );

                $row->column(
                    'bst', $row->countLiveBuys . ' | '. $row->countLiveSells . ' | ' . $row->countLives
                );
            });
            $grid->hideColumns(['sources', 'destinations','trade_allowed', 'api_version','user.name','user.email','api_server_ip','ViewOrders']);

            $mSettings = ManagerSetting::getCurrent();

            if($mSettings && !$mSettings->canHaveAccounts()) {
                $grid->disableCreateButton();
            }

            $grid->filter(function ( $filter) {
                $filter->like('account_number');
                $filter->like('stat.name', 'Name');
                $filter->like('title');

                $options  = UserBrokerServer
                    ::with('broker_server')
                    ->enabled()
                    ->whereHas('broker_server', static function ($server) {
                        $server->api();
                    })
                    ->whereUserId(User::GetManagerId())->get();
                $arr = array();
                foreach ($options as $option) {
                    $arr[$option->broker_server->name] = $option->broker_server->name;
                }
                $filter->equal('broker_server_name', 'Broker')->select($arr);

                $filter->equal('copier_type', 'Type')->select([
                    CopierType::MASTER => CopierType::title(CopierType::MASTER),
                    CopierType::SLAVE => CopierType::title(CopierType::SLAVE),
                ]);
                $filter->in('sources.copier_subscription_id', 'Sender Copier')->multipleSelect(
                    CopierSubscription::whereManagerId(User::GetManagerId())->pluck('title', 'id')
                );
                $filter->in('destinations.copier_subscription_id', 'Follower Copier')->multipleSelect(
                    CopierSubscription::whereManagerId(User::GetManagerId())->pluck('title', 'id')
                );
                $filter->between('stat.balance', 'Balance');
                $filter->disableIdFilter();
            });

            if(Admin::user()->isRole('assistant')) {
                $grid->disableCreateButton();
                $grid->actions(function ($actions) {
                    $actions->disableEdit();
                });
            }

            $grid->tools(function ($tools) use ($api_server_ip) {
                $tools->disableRefreshButton();

                if (Admin::user()->can('mng.copiers')) {
                    $t = new AddToCopierSubscriptionDestGridExt();
                    foreach (CopierSubscription::whereManagerId(User::GetManagerId())->get() as $copier) {
                        $t->add(new AddToCopierSubscriptionDestAction($copier->id, $copier->title));
                    }

                    $tools->append($t);
                }
                $tools->append(new AccountStatusGridExt());
                $api_servers = ApiServer::whereManagerId(User::GetManagerId())->pluck('ip', 'ip');

                $tools->batch(function (Grid\Tools\BatchActions $batch) use($api_servers) {
                    $batch->add('Restart', new AccountStatusBatchAction(AccountStatus::PENDING));
                    $batch->add('Suspend', new AccountStatusBatchAction(AccountStatus::SUSPEND));

                    if(count($api_servers) > 1) {
                        foreach ($api_servers as $key => $value) {
                            $batch->add('Move to - '.$value, new AccountMoveBatchAction($value));
                        }
                    }
                });

                if (count($api_servers) > 1) {
                    $api_servers->prepend('All', '');
                    $api_servers = $api_servers->toArray();

                    $tools->append(new ApiServerGridExt($api_server_ip, $api_servers));
                }

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
        return new Form( new Account(), function (Form $form) {

            //$form->display('id', 'ID');
            $form->hidden('creator_id')->value(User::GetManagerId());
            $form->hidden('manager_id')->value(User::GetManagerId());

            $options = User::whereManagerId(User::GetManagerId())->pluck('name', 'id');
            $options->prepend(Admin::user()->name, Admin::user()->id);
            $form->select('user_id', 'User')->options($options)->required();

            $options  = UserBrokerServer
                ::with('broker_server')
                ->enabled()
                ->whereHas('broker_server', static function ($server) {
                    $server->api();
                })
                ->whereUserId(Admin::user()->id)->get();
            $arr = array();
            foreach ($options as $option) {
                $arr[$option->broker_server->name] = $option->broker_server->name;
            }
            $form->select('broker_server_name', 'Broker Server')
                ->options($arr)
                ->required()
                ->help('To manage Broker Servers, go to <a href="/userbrokerservers">Brokers Page</a>' );

            if ($form->isEditing()) {
                $form->text('account_number', 'Account Number')->disable();
            } else {
                $form->text('account_number', 'Account Number')
                ->creationRules(['required', "unique:accounts"]);
            }

            $pwd = null;
            $u = Admin::user();
            if ($u->can('mng.direct_copier')) {
                $pwd = $form->text('password', 'Password');
                if( $u->can('mng.ea_copier') == false) {
                    $pwd->required()
                        ->help('Use real password for Follower accounts. If account type is Sender investor password is acceptable too');
                } else {
                    $pwd->help('Leave password empty if you are going to use <a href="/test.exe">Slave Expert Advisor</a>');
                }
            }

            if (Admin::user()->can('mng.copiers')) {
                $mSettings = ManagerSetting::whereUserId(User::GetManagerId())->first();
                $options = [
                    CopierType::SLAVE => CopierType::title(CopierType::SLAVE),
                    CopierType::MASTER => CopierType::title(CopierType::MASTER),
                ];

                if($mSettings) {
                    if(!$mSettings->canHaveSenders() ) {
                        Arr::forget($options, CopierType::MASTER);
                    }
                    if(!$mSettings->canHaveFollowers() ) {
                        Arr::forget($options, CopierType::SLAVE);
                    }
                }
                $form->radio('copier_type', 'Type')->values($options)->default(CopierType::SLAVE);
            } else {
                $form->hidden('copier_type')->value(CopierType::MASTER);
            }

            $form->text('title', 'Title');

            $servers = ApiServer::whereManagerId(User::GetManagerId())->pluck('title', 'ip');
            $def = null;
            if (count($servers) > 0) {
                $def = $servers->keys()->first();
            }

            if (Admin::user()->can('mng.api_servers')) {
                $form->select('api_server_ip', 'API Server')->options($servers)->default($def)->required();
            } else {
                $form->hidden('api_server_ip')->value($def);
            }

            $wsHosts = WsHost::whereManagerId(Auth::guard('admin')->user()->id)->pluck('host');
            $wsDef = null;
            if (count($servers) > 0) {
                $wsDef = $wsHosts->first();
            }

            if (Admin::user()->can('mng.ws_hosts')) {
                $form->select('ws_host', 'WS Host')->options($wsHosts)->default($wsDef)->required();
            } else {
                $form->hidden('ws_host')->value($wsDef);
            }

            //$form->switch('build_equity', 'Build Equity?');
            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');

            $form->saving(function ($form) {
                $form->model()->account_status = AccountStatus::PENDING;
            });

            $form->deleting(function (Form $form, $ids) {
                collect(explode(',', $ids))->filter()->each(function ($id) {
                    $account = Account::find($id);
                    $account->account_status = AccountStatus::REMOVING;
                    $account->processing = true;
                    $account->save();

                    ProcessRemovedAccount::dispatch($id)->onQueue($account->getRemovingQueueName());
                });
                $response = [
                    'status'  => true,
                    'message' => trans('admin.delete_succeeded'),
                ];
                return response()->json($response);
            });
        });
    }

    public function add2copier(\Illuminate\Http\Request $request)
    {
        $ids = $request['ids'];

        if (empty($ids)) {
            return;
        }

        $subscription_id = Request::get('copier_subscription_id');
        $subscription = CopierSubscription::whereId($subscription_id)->first();

        foreach (Account::find($ids) as $account) {
            if ($account->copier_type == CopierType::SLAVE) {
                if (!$account->destinations()->where('copier_subscription_id', $subscription_id)->exists()) {
                    $copier = new CopierSubscriptionDestAccount();
                    $copier->setDefaults($subscription);
                    $copier->account_id = $account->id;

                    $copier->save();
                }

                $account->account_status = AccountStatus::PENDING;
                $account->processing = true;
                $account->save();

                ProcessPendingAccount::dispatch($account->id)->onQueue($account->getConnectingQueueName());
            }

            if ($account->copier_type === CopierType::MASTER) {
                if (!$account->sources()->where('copier_subscription_id', $subscription_id)->exists()) {
                    $source = new CopierSubscriptionSourceAccount();
                    $source->account_id = $account->id;
                    $source->copier_subscription_id = $subscription_id;

                    $source->save();
                }

                $account->processing = true;
                $account->account_status = AccountStatus::PENDING;
                $account->save();

                ProcessPendingAccount::dispatch($account->id)->onQueue($account->getConnectingQueueName());
            }
        }
    }

    public function update_status(\Illuminate\Http\Request $request)
    {
        foreach (Account::find($request['ids']) as $account) {
            $status = $request['status'];

            if($status == AccountStatus::PENDING || $status == AccountStatus::REMOVING) {
                $account->processing = true;
            }
            $account->account_status = $status;
            $account->save();

            if($status == AccountStatus::PENDING) {
                ProcessPendingAccount::dispatch($account->id)->onQueue($account->getConnectingQueueName());
            }

            if($status == AccountStatus::REMOVING) {
                ProcessRemovedAccount::dispatch($account->id)->onQueue($account->getRemovingQueueName());
            }
        }

        $response = [
            'status'  => true,
            'message' => trans('admin.update_succeeded'),
        ];
        return response()->json($response);
    }

    public function move_to(\Illuminate\Http\Request $request)
    {
        foreach (Account::find($request['ids']) as $account) {
            $ip = $request['ip'];

            $account->old_api_server_ip = $account->api_server_ip;
            $account->api_server_ip = $ip;
            $account->processing = true;
            $account->account_status = AccountStatus::PENDING;
            $account->save();

            ProcessPendingAccount::dispatch($account->id)->onQueue($account->getConnectingQueueName());
        }

        $response = [
            'status'  => true,
            'message' => trans('admin.update_succeeded'),
        ];
        return response()->json($response);
    }
}

