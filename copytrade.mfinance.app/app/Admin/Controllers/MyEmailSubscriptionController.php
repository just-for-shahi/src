<?php

namespace App\Admin\Controllers;

use App\Models\EmailSubscription;
use App\Models\UserEmailSubscription;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;

class MyEmailSubscriptionController extends AdminController
{
    protected function title() {
        return __('admin.my_email_subscriptions');
    }

    public function index(Content $content)
    {
        return new Content(function (Content $content) {
            $content->header($this->title());
            $content->description('Subscribe to receive trade and account alerts');

            $content->row(function ($row) {
                $row->column(12, $this->gridPublic());
                $row->column(12, $this->gridSubscribed());
            });
        });
    }

    protected function gridPublic()
    {
        return new Grid(new EmailSubscription(), function (Grid $grid) {
            $grid->model()->whereManager(Admin::user()->manager_id)->public();

            $grid->title(__('admin.email_subscription'));
            $grid->column('_subscribe', __('admin.subscribe'));

            $grid->rows(function (Grid\Row $row) {
                $row->column('_subscribe', '<a class="btn btn-sm btn-success" href="/myemailsubscriptions/subscribe/'.$row->id.'" >Subscribe</a>' );
            });

            $grid->disableCreateButton();
            $grid->disableExport();
            $grid->disableActions();
            $grid->disableFilter();
            $grid->disableColumnSelector();
            $grid->disableRowSelector();
            $grid->disablePagination();
            $grid->disableTools();
        });
    }

    protected function gridSubscribed()
    {
        return new Grid(new UserEmailSubscription(), function (Grid $grid) {
            $grid->model()->whereUserId(Admin::user()->id);

            $grid->email('Email')->editable();

            $grid->subscription()->title(__('admin.email_subscription'))->label();

            $grid->enabled('Enabled?')->switch()->sortable();

            $grid->disableCreateButton();
            $grid->disableExport();
            $grid->disableActions();
            $grid->disableFilter();
            $grid->disableColumnSelector();
            //$grid->disableTools();
            //$grid->disableRowSelector();
        });
    }

    protected function form()
    {
        return new Form( new UserEmailSubscription(), function (Form $form) {
            $form->email('email', 'Email');
            $form->switch('enabled', 'Enabled?');

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }

    public function subscribe($id) {
        $subscription = new UserEmailSubscription();
        $subscription->user_id = Admin::user()->id;
        $subscription->email = Admin::user()->email;
        $subscription->email_subscription_id = $id;
        $subscription->enabled = 1;

        $subscription->save();

        admin_toastr(trans('admin.subscribed'));

        return redirect('myemailsubscriptions');
    }
}
