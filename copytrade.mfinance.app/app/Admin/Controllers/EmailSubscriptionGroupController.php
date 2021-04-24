<?php

namespace App\Admin\Controllers;

use App\Models\EmailSubscription;
use App\Models\EmailSubscriptionGroup;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;

class EmailSubscriptionGroupController extends AdminController
{

    protected function title() {
        return trans('admin.email_subscription_groups');
    }

    protected function grid()
    {
        return new Grid( new EmailSubscriptionGroup(), function (Grid $grid) {

            $grid->model()->whereManagerId(Admin::user()->id);

            $grid->id('ID');
            $grid->title('Title');
            $grid->subscriptions('Subscriptions')->pluck('title')->label();

            $grid->created_at()->sortable();
            $grid->updated_at();

            $grid->filter(function ($filter) {
                $filter->like('title');
                $filter->disableIdFilter();
            });

            $grid->tools(function ($tools) {
                $tools->disableRefreshButton();
            });

            $grid->actions(function ($actions) {
                $actions->disableView();
            });
        });
    }

    protected function form()
    {
        return new Form(new EmailSubscriptionGroup(), function (Form $form) {
            $form->hidden('manager_id')->value(Admin::user()->id);

            $form->text('title', 'Title')->required();

            $subscriptions = EmailSubscription::whereManagerId(Admin::user()->id)->pluck('title', 'id');
            $form->multipleSelect('subscriptions', 'Subscriptions')->options($subscriptions)->required()->allowSelectAll();

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
