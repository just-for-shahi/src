<?php

namespace App\Admin\Controllers;

use App\Models\BrokerServer;
use App\Models\UserBrokerServer;
use App\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;

class UserBrokerServerController extends AdminController
{
    protected function title() {
        return trans('admin.my_broker_servers');
    }

    protected function grid()
    {
        return new Grid(new UserBrokerServer(), function (Grid $grid) {
            $grid->id('ID');
            $grid->model()->whereUserId(User::GetManagerId());

            $grid->broker_server()->name('Name')->sortable();
            $grid->broker_server()->suffix('Suffix')->sortable();

            $grid->updated_at();

            $states = [
                '1' => ['text' => 'Yes'],
                '0' => ['text' => 'No'],
            ];

            $grid->enabled()->switch($states)->sortable();

            $grid->filter(function ($filter) {
                $filter->like('broker_server.name', 'Name');
                $filter->disableIdFilter();
                $filter->expand();
            });
            //$grid->disableTools();
            //$grid->disableCreation();
            $grid->disableExport();
            $grid->disableActions();
            $grid->disableRowSelector();
        });
    }

    protected function form()
    {
        return new Form(new UserBrokerServer(), function (Form $form) {
            $form->hidden('user_id')->value(Admin::user()->id);
            $form->hidden('broker_server_id')->value(0);

            $form->switch('enabled', 'Enabled?')->default(1);

            $form->file('srv_file_path', __('Srv File'))->required();
            $form->number('gmt_offset', 'GMT Offset')->default(0);
            $form->text('suffix', 'Pairs Suffix')->help('Example: pair name is "EURUSD.m" then suffix is ".m"');

            $form->saving(function ($form) {

                if (!is_null($form->srv_file_path)) {
                    $name = str_replace('.srv', '', $form->srv_file_path->getClientOriginalName());

                    BrokerServer::deleteByName($name);

                    $brokerServer = new BrokerServer;

                    $brokerServer->suffix = $form->suffix;
                    $brokerServer->name = $name;
                    $brokerServer->srv_file = $form->srv_file_path->get();
                    $brokerServer->is_updated_or_new = 1;
                    $brokerServer->save();

                    $uBroker = new UserBrokerServer;

                    $uBroker->broker_server_id = $brokerServer->id;
                    $uBroker->enabled = $form->enabled == 'on' ? 1 : 0;
                    $uBroker->user_id = $form->user_id;

                    $uBroker->save();

                    return redirect($form->resource(0));
                }
            });
        });
    }

}
