<?php

namespace App\Admin\Controllers;

use App\User;
use App\Models\Order;
use App\Models\OrderStatus;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;

class StrategyOrderController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {
            $content->header('Orders');
            $content->description('Manage Orders');

            $content->body($this->grid());
        });
    }

    protected function show($id)
    {
        $show = new Show(Order::findOrFail($id));

        $show->ticket('ticket');
        $show->updated_at('Updated');

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
            $content->header('Order');
            $content->description('Edit Order');
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
            $content->header('Order');
            $content->description('New Order');

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
        return Admin::grid(Order::class, function (Grid $grid) {
            $grid->model()->orderBy('time_close', 'DESC');
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

            $grid->filter(function ($filter) {
                $filter->disableIdFilter();
            });

            $grid->tools(function ($tools) {
            });

            $grid->disableCreation();
            $grid->actions(function ($actions) {
                $actions->disableView();
            });
        });
    }
}
