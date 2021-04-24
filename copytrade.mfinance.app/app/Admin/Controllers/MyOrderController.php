<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\Tools\OrderCloseBatchAction;
use App\Helpers\MT4Commands;
use App\Models\Account;
use App\Models\Order;
use App\Models\OrderStatus;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Grid;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;

class MyOrderController extends AdminController
{
    protected function title()
    {
        return trans('admin.my_trades');
    }

    protected function grid()
    {
        return new Grid(new Order(), function (Grid $grid) {
            $accounts = Account::where([['user_id', Admin::user()->id]])->pluck('account_number', 'account_number');

            $grid->model()
                ->where('magic', '!=', 0)
                ->whereIn('account_number', $accounts->keys())
                ->whereIn('type', [0, 1])
                ->orderBy('status', 'ASC')->orderBy('time_close', 'DESC');

            $grid->status('Status')->display(function ($status) {
                return OrderStatus::title($status);
            });
            $grid->ticket('Ticket');
            $grid->symbol('Symbol');
            $grid->type_str('Type')->display(function ($type) {
                if ($type == 'BUY') {
                    return '<span class="label label-success">BUY</span>';
                } else {
                    return '<span class="label label-danger">SELL</span>';
                }
            });

            $grid->lots('Lots');
            $grid->price('Price');
            $grid->price_close('Closed');
            $grid->time_open('Time');
            $grid->time_close('Closed');
            $grid->pl('P/L');
            $grid->pips('Pips');
            $grid->comment('Strategy');

            $grid->filter(function (Grid\Filter $filter) use ($accounts) {
                $filter->expand();
                $filter->disableIdFilter();

                if (count($accounts) > 0) {
                    $def = $accounts->keys()->first();

                    $filter->equal('account_number', 'Account')->select($accounts)->default($def);
                }
            });

            $grid->rows(function ($row) {
                if ($row->pl >= 0) {
                    $row->style('color:green');
                } else {
                    $row->style('color:red');
                }
            });
            $grid->disableExport();
            $grid->disableCreateButton();
            $grid->disableActions();
            $grid->actions(function ($actions) {
                $actions->disableView();
            });

            $grid->tools(function ($tools) use($accounts) {

                $acc = Request::get('account_number');

                if (empty($acc) && count($accounts) > 0)
                    $acc = $accounts->keys()->first();

                $tools->batch(function (Grid\Tools\BatchActions $batch) use($acc) {
                    $batch->add('Close', new OrderCloseBatchAction($acc));
                });
            });

        });
    }

    public function close_order(\Illuminate\Http\Request $request)
    {
        try {
            MT4Commands::wsSendOrderCloseSignal($request['acc'], $request['ids']);

            $response = [
                'status'  => true,
                'message' => trans('admin.update_succeeded'),
            ];

        } catch(\Exception $e) {
            Log::Exception($e);
            $response = [
                'status'  => false,
                'message' => trans('admin.update_failed'),
            ];

        }

        return response()->json($response);
    }
}
