<?php

namespace App\Admin\Controllers;

use App\Models\UserCopierSubscription;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Grid;

class MyCopierSubscriptionController extends AdminController
{
    protected function title() {
        return trans('admin.my_subscriptions');
    }

    protected function grid()
    {
        return new Grid(new UserCopierSubscription(), function (Grid $grid) {
            $grid->model()->whereUserId(Admin::user()->id);

            $grid->id('ID')->sortable();

            $grid->subscription()->title('Title');

            $grid->expired_at()->display(function ($date) {
                return is_null($date) ? 'never' : $date;
            });

            $grid->disableExport();
            $grid->disableActions();
            $grid->disableFilter();
            $grid->disableCreateButton();
        });
    }

}
