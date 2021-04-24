<?php

namespace App\Admin\Controllers;

use App\Models\BrokerServer;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;

class BrokerServerController extends AdminController
{

    protected function title()
    {
        return trans('admin.broker_servers');
    }

    protected function grid()
    {
        return new Grid(new BrokerServer(), function (Grid $grid) {
            $grid->id('ID')->sortable();

            $grid->name('Name')->sortable();
            $grid->gmt_offset('GMT Offset');
            $grid->suffix('Suffix');

            $grid->accounts('#Accounts')->display(function ($account) {
                $count = count($account);
                return "<span class='label label-warning'>{$count}</span>";
            });

            $grid->created_at();
            $grid->updated_at();

            $grid->filter(function ($filter) {
                $filter->like('name');
                $filter->disableIdFilter();
            });
            $grid->actions(function ($actions) {
                $actions->disableView();
            });
            $grid->rows(function ($row) {
            });
        });
    }

    protected function form()
    {
        return new Form( new BrokerServer(), function (Form $form) {
            $form->display('id', 'ID');

            if ($form->isEditing()) {
                $form->display('name', 'Name');
            }

            if($form->isCreating())
                $form->file('srv_file_path', __('Srv File'))->required();
            else
                $form->file('srv_file_path', __('Srv File'));

            $form->number('gmt_offset', 'GMT Offset')->default(0);
            $form->text('suffix', 'Pairs Suffix')->help('Example: pair name is "EURUSD.m" then suffix is ".m"');

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');

            $form->saving(function ($form) {
                if (!is_null($form->srv_file_path)) {
                    $form->model()->name = str_replace('.srv', '', $form->srv_file_path->getClientOriginalName());
                    $form->model()->srv_file = $form->srv_file_path->get();
                    $form->model()->is_updated_or_new = 1;
                }
            });
        });
    }

}
