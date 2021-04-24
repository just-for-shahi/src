<?php

namespace App\Admin\Controllers;
use App\Models\Portfolio;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;

class MyPortfolioController extends AdminController
{

    protected function title() {
        return trans('admin.my_porfolios');
    }

    public function index(Content $content)
    {
        return $content
            ->title($this->title())
            ->description(trans('admin.my_porfolios_list'))
            ->body($this->grid());
    }

    public function show($id, Content $content)
    {
        return redirect("portfolio-trades?&id=$id");
    }

    protected function grid()
    {
        return new Grid( new Portfolio(), function (Grid $grid) {
            $grid->model()->whereManagerId(Admin::user()->manager_id)->where('is_public', 1);

            $grid->title(__('admin.title'))->label();

            $grid->initial_deposit(__('admin.deposit'));
            $grid->column('stat.net_profit',__('admin.equity'));
            $grid->column('stat.net_pl',__('admin.net_pl'));
            $grid->column('stat.total_lots',__('admin.total_lots'));
            $grid->column('stat.drawdown_perc',__('admin.drawdown_perc'));
            $grid->column('stat.nof_closed',__('admin.orders_count'));

            $grid->actions(function ($actions) {
                $actions->disableDelete();
                $actions->disableEdit();
            });

            $grid->disableExport();
            //$grid->disableActions();
            $grid->disableFilter();
            $grid->disableCreateButton();
            $grid->disableBatchActions();
        });
    }

}