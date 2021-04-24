<?php

namespace App\Admin\Controllers;

use App\Models\EmailSubscription;
use App\Models\UserEmailSubscription;

use App\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Illuminate\Support\Facades\Auth;

class UserEmailSubscriptionController extends AdminController
{

    protected function title() {
        return trans('admin.users_email_subscriptions');
    }

    protected function grid()
    {
        return new Grid(new UserEmailSubscription(), function (Grid $grid) {
            $grid->model()->whereHas('subscription', function ($q) {
                $q->whereManagerId(Auth('admin')->user()->id);
            });

            $grid->id('ID')->sortable();

            $grid->subscription()->title('Subscription')->label();

            $grid->user()->email('User Email');
            $grid->email('Subscription Email')->editable();

            $states = [
                '1' => ['text' => 'Yes'],
                '0' => ['text' => 'No'],
            ];
            $grid->enabled('Enabled?')->switch($states)->sortable();

            $grid->created_at();
            $grid->updated_at()->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->expand();
                $filter->disableIdFilter();

                $filter->like('email');

                $filter->equal('email_subscription_id', 'Subscription')->select(EmailSubscription::whereManagerId(Auth::guard('admin')->user()->id)->pluck('title', 'id'));
            });
            //$grid->disableExport();
            //$grid->disableFilter();
            $grid->actions(function ($actions) {
                $actions->disableView();
            });
        });
    }

    protected function form()
    {
        return new Form(new UserEmailSubscription(), function (Form $form) {
            $options = User::whereManagerId(Auth('admin')->user()->id)->selectRaw('CONCAT (name, " - ", email) as c, id')->pluck('c', 'id');
            $me = Auth('admin')->user();
            $options->prepend($me->name.' - '.$me->email, $me->id);
            $form->select('user_id', 'User')->options($options)->required();

            $form->select('email_subscription_id', 'Subscription')
                ->options(EmailSubscription::whereManagerId(Auth('admin')->user()->id)->pluck('title', 'id'))->required();

            $form->text('email', 'Email')->help('Leave it empty User email will be used');

            $form->switch('enabled', 'Enabled?')->default(1);

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');

            $form->saving(function (Form $form) {
                if (empty($form->email && !empty($form->user_id))) {
                    $user = User::find($form->user_id);
                    if ($user) {
                        $form->email = $user->email;
                    }
                }
            });
        });
    }
}
