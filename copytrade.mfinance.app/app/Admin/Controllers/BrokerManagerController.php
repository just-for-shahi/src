<?php

namespace App\Admin\Controllers;

use App\Models\BrokerManager;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;

class BrokerManagerController extends AdminController
{

    protected function title() {
        return trans('admin.broker_managers');
    }

    protected function grid()
    {
        return new Grid(new BrokerManager(), function (Grid $grid) {

            //$grid->disableBatchDeletion();

            $grid->id('ID')->sortable();
            $grid->ip('IP');
            $grid->port('Port');
            $grid->login('Login');

            $grid->created_at();
            $grid->updated_at();

            $grid->filter(function ($filter) {
                $filter->disableIdFilter();
            });

            $grid->actions(function ($actions) {
                $actions->disableView();
            });

            $grid->rows(function ($row) {
                if ($row->enabled == 1) {
                    $row->style('color:green');
                } else {
                    $row->style('color:red');
                }
            });
        });
    }

    protected function form()
    {
        return new Form(new BrokerManager(), function (Form $form) {
            $form->display('id', 'ID');

            $form->ip('ip', 'IP');
            $form->number('port', 'Port');
            $form->text('login', 'Login');
            $form->text('password', 'Password');

            $form->switch('enabled', 'Enabled?');

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
