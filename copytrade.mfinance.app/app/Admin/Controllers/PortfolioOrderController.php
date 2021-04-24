<?php

namespace App\Admin\Controllers;

use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Portfolio;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Grid;
use Illuminate\Support\Facades\Request;
use Encore\Admin\Layout\Content;

class PortfolioOrderController extends AdminController
{
    public function index(Content $content)
    {
        $description = '';
        $title = '';
        $portfolioId = Request::get('id');

        if(!empty($portfolioId)) {
            $portfolio = Portfolio::find($portfolioId);

            if($portfolio) {
                $description = $portfolio->description;
                $title = $portfolio->title;
            }
        }
        return $content
            ->title($title)
            ->description($description)
            ->body($this->grid());
    }

    protected function grid()
    {
        return new Grid(new Order(), function (Grid $grid) {
            $accountNumbers = array();

            $portfolioId = Request::get('id');

            if(!empty($portfolioId)) {
                $portfolio = Portfolio::find($portfolioId);

                if($portfolio)
                    $accountNumbers = $portfolio->accounts()->pluck('account_number')->toArray();
            }

            $grid->model()
                ->whereIn('account_number', $accountNumbers)
                ->whereIn('type', [0, 1])
                ->orderBy('status', 'ASC')->orderBy('time_close', 'DESC');

            $grid->status('Status')->display(function ($status) {
                return OrderStatus::title($status);
            });
            $grid->ticket('Ticket');
            $grid->symbol('Symbol');
            $grid->type_str('Type');
            $grid->lots('Lots');
            $grid->price('Price');
            $grid->price_close('Closed');
            $grid->time_open('Time');
            $grid->time_close('Closed');
            $grid->pl('P/L')->display(function ($pl) {
                if ($pl >= 0) {
                    return "<span style='color: #00a65a; font-weight: bold;'>$pl</span>";
                } else {
                    return "<span style='color: #dd4b39; font-weight: bold;'>$pl</span>";
                }
            });
            $grid->pips('Pips');
            //$grid->comment('Strategy');

            $grid->rows(function ($row) {
                // if ($row->pl >= 0) {
                //     $row->style('color:green');
                // } else {
                //     $row->style('color:red');
                // }
            });

            $grid->disableFilter();
            $grid->disableExport();
            $grid->disableCreateButton();
            $grid->disableActions();
            $grid->disableBatchActions();
        });
    }
}
