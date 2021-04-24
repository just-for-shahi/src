<?php

namespace App\Admin\Controllers;

use App\Models\LicensePreset;
use App\Models\Product;
use App\Models\UserBrokerServer;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;

class LicensePackageController extends AdminController
{
    protected function title() {
        return trans('admin.packages');
    }

    protected function grid()
    {
        return new Grid( new LicensePreset(), function (Grid $grid) {

            $grid->model()->whereManagerId(Admin::user()->id);

            $grid->id('ID')->sortable();
            $grid->title('Title')->editable();
            $grid->products('Products')->pluck('title')->badge('blue');
            $grid->expiration_days('Expiration')->editable();
            $grid->max_live_accounts('Max Live')->editable();
            $grid->max_demo_accounts('Max Demo')->editable();
            $grid->single_pc('Single PC')->switch()->sortable();
            $grid->auto_confirm_new_accounts('Auto Confirm')->switch();
            $grid->brokers('Brokers')->display(function ($broker) {
                $count = count($broker);
                if($count == 0)
                    return "<span class='label label-warning'>all</span>";
                return "<span class='label label-warning'>{$count}</span>";
            });

            $grid->created_at('Created');
            $grid->updated_at('Updated');

            $grid->filter(function ($filter) {
                $filter->disableIdFilter();
            });

            $grid->actions(function ($actions) {
                $actions->disableView();
                //$actions->disableDelete();
            });

            $grid->rows(function ($row) {
            });
        });
    }

    protected function form()
    {
        return new Form( new LicensePreset(), function (Form $form) {
            $u = Admin::user();
            $form->hidden('manager_id')->value($u->id);

            $form->display('id', 'ID');

            $form->text('title', 'Title')->required();
            $form->textarea('description', 'Description');

            $products = Product::whereManagerId($u->id)->pluck('title', 'id');
            $form->multipleSelect('products', 'Products')
                ->options($products)
                ->required()
                ->allowSelectAll();

            $form->number('expiration_days', 'Expiration Days')
                ->default(7)
                ->help('Set -1 to make lifetime license');
            $form->number('max_live_accounts', 'Max Live Accounts')->default(1);
            $form->number('max_demo_accounts', 'Max Demo Accounts')->default(1);


            $options  = UserBrokerServer
                ::with('broker_server')
                ->enabled()
                ->whereUserId($u->id)->get();
            $arr = array();
            foreach ($options as $option) {
                if($option->broker_server)
                    $arr[$option->broker_server->name] = $option->broker_server->name;
            }
            $form->multipleSelect('brokers', 'Brokers')->options($arr);

            $form->switch('single_pc', 'Single PC?')->default(1);
            $form->switch('auto_confirm_new_accounts', 'Auto Confirm New Accounts?')->default(1);
            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');

            $form->disableViewCheck();
            $form->disableEditingCheck();
            $form->disableCreatingCheck();
            $form->tools(function (Form\Tools $tools) {
                $tools->disableView();
            });
        });
    }
}
