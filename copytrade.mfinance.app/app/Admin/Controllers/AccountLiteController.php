<?php

namespace App\Admin\Controllers;

use Encore\Admin\Form;
use Carbon\Carbon;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\Account;
use App\Models\Member;
use Encore\Admin\Facades\Admin;

use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;

use Encore\Admin\Controllers\HasResourceActions;

class AccountLiteController extends Controller
{
    use HasResourceActions;

    public function index()
    {
        return Admin::content(function (Content $content) {
            $content->header('Accounts');
            $content->description('Manage Accounts');

            $content->body($this->grid());
        });
    }

    protected function show($id)
    {
        $show = new Show(Account::findOrFail($id));

        $show->account_number('Account Number');
        $show->broker_server_name('Broker Server');
        $show->is_live('Live or Demo')->as(function ($val) {
            return $val == 1 ? 'Live' : 'Demo';
        });
        $show->created_at('Created');
        $show->updated_at('Updated');

        $show->orders('Deposits/Withdrawals', function ($order) {
            $order->model()->whereIn('type', [6,7]);
            $order->disableTools();
            $order->disableExport();
            $order->disableFilter();
            $order->disableCreation();
            $order->disableActions();
            $order->resource('/funds');

            $order->type_str('Action');
            $order->time_close('Time');
            $order->pl('Amount');
        });

        return $show;
    }

    protected function form()
    {
        return Admin::form(Account::class, function (Form $form) {});
    }
    public function edit($id)
    {
        return $this->show($id);
    }

    protected function grid()
    {
        return Admin::grid(Account::class, function (Grid $grid) {
            $grid->model()->with('stat');//->whereManagerId(Auth('admin')->user()->id);

            $grid->id('ID');

            $grid->account_number('Account');
            $grid->stat()->name('Name');
            //$grid->user()->name('User');
            $grid->broker_server_name('Broker')->sortable();

            $grid->stat()->balance('Balance');

            $grid->updated_at('Updated')->display(function ($updated_at) {
                return Carbon::parse($updated_at)->diffForHumans();
            });

            $grid->rows(function (Grid\Row $row) {

            });

            $def = null;
            $members = Member
                ::with('user')
                ->whereHas('user', static function ($user) {
                    $user->whereManagerId(Auth('admin')->user()->id);
                })->get();

            if (count($members) > 0) {
                $def = $members->values()->first()->user_id;
            }
            $arr = array();
            foreach ($members as $m) {
                $arr[$m->user_id] = $m->user->email.' - '. $m->user->name. ' - '.$m->license_key;
            }
            $grid->filter(function ($filter) use($arr, $def) {
                $filter->equal('user_id', 'Member')->select($arr)->default($def);
                $filter->disableIdFilter();
                $filter->expand();
            });

            $grid->tools(function ($tools) {
                $tools->disableRefreshButton();
            });

            $grid->disableCreation();
            //$grid->disableBatchDeletion();
//            $grid->disableExport();
            //$grid->disableActions();
            //$grid->disableFilter();
        });
    }

}
