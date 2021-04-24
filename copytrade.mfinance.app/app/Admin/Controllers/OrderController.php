<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\Tools\OrderCloseBatchAction;
use App\Helpers\MT4Commands;
use App\Models\Order;
use App\Models\OrderStatus;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;

class OrderController extends AdminController
{
    protected function title() {
        return trans('admin.orders');
    }

    protected function details($id)
    {
        $show = new Show(Order::findOrFail($id));

        $show->ticket('ticket');
        $show->updated_at('Updated');

        return $show;
    }

    protected function grid()
    {
        return new Grid(new Order(), function (Grid $grid) {

            $grid->model()->orderBy('status', 'ASC')->orderBy('time_close', 'DESC');

            $req_status = Request::get('status');

            if($req_status == OrderStatus::NOT_FILLED) {
                $grid->created_at('Time')->sortable();
                $grid->last_error('Error');
            } else {
                $grid->status('Status')->display(function ($status) {
                    return OrderStatus::title($status);
                })->sortable();

                $grid->symbol('Symbol');
                $grid->type_str('Type')->sortable();
                $grid->lots('Lots');
                $grid->price('Price');
                $grid->stoploss('Stoploss');
                $grid->takeprofit('TakPprofit');
                $grid->time_open('Time');
                $grid->time_close('Closed');
                $grid->price_close('PriceClose');
                $grid->pl('P/L');
            }

            $grid->filter(function ($filter) {
                $filter->expand();
                $filter->like('account_number');
                $filter->equal('status', 'Status')->select([
                    OrderStatus::NOT_FILLED => OrderStatus::title(OrderStatus::NOT_FILLED),
                    OrderStatus::OPEN => OrderStatus::title(OrderStatus::OPEN),
                    OrderStatus::CLOSED => OrderStatus::title(OrderStatus::CLOSED),
                ]);
                $filter->disableIdFilter();
            });

            $grid->tools(function ($tools) {

                $tools->batch(function (Grid\Tools\BatchActions $batch) {
                    $batch->add('Close', new OrderCloseBatchAction(Request::get('account_number')));
                });
            });

            $grid->disableCreateButton();
            $grid->disableActions();
            //$grid->disableBatchActions();
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
