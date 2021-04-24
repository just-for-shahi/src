<?php

namespace App\Admin\Controllers;

use App\Models\ApiServer;
use App\Models\ApiServerStatus;

use App\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;

class ApiServerController extends AdminController
{

    protected function ttile()
    {
        return trans('admin.api_servers');
    }

    protected function grid()
    {
        return new Grid(new ApiServer(), function (Grid $grid) {

            //$grid->disableBatchDeletion();

            $grid->id('ID')->sortable();
            $grid->ip('IP');
            $grid->title('Title');
            $grid->host_name('Host');

            $states = [
                '1' => ['text' => 'Yes'],
                '0' => ['text' => 'No'],
            ];

            $grid->enabled()->switch($states)->sortable();

            $grid->mem('RAM')->display(function ($mem) {
                return $mem . '%';
            });
            $grid->cpu('CPU')->display(function ($cpu) {
                return $cpu . '%';
            });

            $grid->manager()->name('Manager');

            $grid->api_server_status('Status')->display(function ($status) {
                return ApiServerStatus::title($status);
            });

            $grid->accounts('#Accounts')->display(function ($account) {
                $count = count($account);
                return "<span class='label label-warning'>{$count}</span>";
            });

            //$grid->created_at();
            //$grid->updated_at();

            $grid->filter(function ($filter) {
                $filter->disableIdFilter();
            });

            $grid->actions(function ($actions) {
                $actions->disableView();
            });

            $grid->rows(function ($row) {

                //add style to lines which Id less than 10
                if ($row->enabled == 1) {
                    $row->style('color:green');
                    //                    $row->actions()->add(function ($row) {
                    //                      return "<a class=\"btn btn-xs\">Disable</a>";
                    //                });
                } else {
                    $row->style('color:red');
                    //              $row->actions()->add(function ($row) {
                    //                return "<a class=\"btn btn-xs\">Enable</a>";
                    //          });
                }
            });
        });
    }

    protected function form()
    {
        return new Form(new ApiServer(), function (Form $form) {
            $form->display('id', 'ID');

            $form->ip('ip', 'IP');
            $form->text('title', 'Title');

            $form->switch('enabled', 'Enabled?')->default(1);

            $options = User::whereNull('creator_id')->pluck('name', 'id');
            $form->select('manager_id', 'Manager')->options($options)->required();

            $form->number('max_accounts', 'Max Accounts');

            $form->switch('enabled', 'Enabled?');

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
