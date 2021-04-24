<?php

namespace App\Admin\Controllers;

use Carbon\Carbon;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\Account;
use App\Models\Product;
use App\Models\MemberProductAccount;
use App\Models\BrokerServer;
use Encore\Admin\Facades\Admin;
use App\Models\UserBrokerServer;

use Encore\Admin\Layout\Content;
use App\Models\CopierSubscription;
use App\Jobs\ProcessPendingAccount;
use App\Jobs\ProcessRemovedAccount;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Encore\Admin\Controllers\HasResourceActions;
use App\Admin\Extensions\Tools\AccountStatusGridExt;
use App\Admin\Extensions\Tools\AccountStatusBatchAction;
use App\Admin\Extensions\Tools\AccountMoveBatchAction;
use App\Admin\Extensions\Tools\AddToCopierSubscriptionDestAction;
use App\Admin\Extensions\Tools\AddToCopierSubscriptionDestGridExt;

class ProductMemberAccountController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {
            $content->header('Licenses and Accounts');
            $content->description('Manage Memebers and Accounts');

            $content->body($this->grid());
        });
    }

    protected function show($id)
    {
        $show = new Show(Account::findOrFail($id));

        $show->account_number('Account Number');
        $show->name('Account Name');
        $show->title('Title');
        $show->broker_server_name('Broker Server');
        $show->is_live('Live or Demo')->as(function ($val) {
            return $val == 1 ? 'Live' : 'Demo';
        });
        $show->currency('Currency');
        $show->api_version('API Version');
        $show->Company('Broker Company');

        $show->funds('Funds', function ($order) {
            $order->resource('/funds');

            $order->time_close('Time');
            $order->pl('Amount');
        });

        return $show;
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {
            $content->header('Account');
            $content->description('Edit Account');
            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {
            $content->header('Account');
            $content->description('New Account');

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
        return Admin::grid(MemberProductAccount::class, function (Grid $grid) {
            $states = [
                '1' => ['text' => 'Yes'],
                '0' => ['text' => 'No'],
            ];


            $grid->model()
                ->with('member')->with('account')->with('user')->with('stat')
                ->whereHas('user', function ($query){
                    $query->whereManagerId(Auth('admin')->user()->id);
                })
                ->orderBy('confirmed');

            $grid->id('ID');
            $grid->column('user.name','User')->filter()->sortable()->ucfirst()->limit(10);
            $grid->column('user.email','Email')->sortable();
            $grid->column('member.license_key', 'License')->sortable()->copyable();
            $grid->column('product.title', 'Product')->sortable()->badge('blue');
            $grid->column('account.account_number','Account')->sortable();
            $grid->column('account.broker_server_name','Broker')->sortable();
            $grid->column('stat.balance','Balance')->sortable();

            $grid->column('product.version','Ver#');
            $grid->updated_at('Updated')->display(function ($updated_at) {
                return Carbon::parse($updated_at)->diffForHumans();
            });

            $grid->confirmed()->switch($states)->sortable();

            $grid->rows(function (Grid\Row $row) {

            });
            $grid->hideColumns(['product.version','updated_at']);

            $grid->filter(function ($filter) {
                $filter->scope('new', 'Added today')->whereDate('created_at', date('Y-m-d'));
                $filter->scope('Confirmed')->where('confirmed', '=', 1);
                $filter->scope('UnConfirmed')->where('confirmed', '=', 0);
                $filter->scope('Demo')->whereHas('account', function ($query) {
                    $query->where('is_live', '0');
                });
                $filter->scope('Live')->whereHas('account', function ($query) {
                    $query->where('is_live', '1');
                });

                //$filter->like('product.title', 'Product');
                $filter->equal('product.id', 'Product')
                    ->select(Product::whereManagerId(Auth('admin')->user()->id)->pluck('title', 'id'));

                $filter->like('user.name', 'Name');
                $filter->like('user.email', 'Email');
                $filter->like('account.account_number', 'Account');
                $filter->like('account.broker_server_name', 'Broker');

                $filter->group('stat.balance', 'Balance', function ($group) {
                    $group->gt('More');
                    $group->lt('Less');
                });
                $filter->disableIdFilter();
            });

            $grid->tools(function ($tools) {
                $tools->disableRefreshButton();
            });
            $grid->disableActions();
            $grid->disableCreation();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(MemberProductAccount::class, function (Form $form) {
            $form->switch('confirmed', 'Confirmed?');
        });
    }

}
