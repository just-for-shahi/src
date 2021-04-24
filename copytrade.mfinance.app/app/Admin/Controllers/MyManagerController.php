<?php

namespace App\Admin\Controllers;

use App\Models\CopierRiskType;
use App\Models\CopierSubscription;
use App\Models\ManagerSetting;
use App\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;

class MyManagerController extends AdminController
{

    protected function title()
    {
        return trans('admin.manager');
    }

    protected function grid()
    {
        return new Grid(new ManagerSetting(), function (Grid $grid) {
            $grid->model()
                ->whereHas('user', static function ($q) {
                    $q->whereManagerId(Admin::user()->id);
                });

            $grid->id('ID')->sortable();

            $grid->column('user.name','Name')->sortable();

            $grid->copiers('Copiers')->pluck('title')->badge('blue');
            $grid->senderCount('#Senders');;
            $grid->followerCount('#Followers');;
            $grid->accounts('#Accounts')->display(function ($account) {
                return count($account);
            });
            $grid->users('#Users')->display(function ($user) {
                return count($user);
            });

            $grid->column('impersonate', 'Impersonate');

            $grid->created_at();
            $grid->updated_at();

            $grid->filter(function ($filter) {
                $filter->like('user.name');
                $filter->disableIdFilter();
            });
            $grid->actions(function ($actions) {
                $actions->disableView();
            });

            $grid->rows(function (Grid\Row $row) {
                $row->column(
                    'impersonate',
                    '<a href="'.url('/user/impersonate/'.$row->user_id).'">Go</a>'
                );
            });
        });
    }

    protected function form()
    {
        return new Form(new ManagerSetting(), function (Form $form) {
            $form->display('id', 'ID');

            $users = User::where('manager_id', Admin::user()->id)->pluck('name', 'id');
            $form->select('user_id', trans('admin.select_user'))->options($users)->required();

            $form->number('max_copiers', 'Max Copiers')
                ->default(0)
                ->help('0 - means unlimited');

            $form->number('max_senders', 'Max Senders')
                ->default(0)
                ->help('0 - means unlimited');

            $form->number('max_followers', 'Max Followers')
                ->default(0)
                ->help('0 - means unlimited');

            $form->switch('can_edit_brokers', 'Allow Edit Brokers')->default(1);
            $form->switch('create_default_subscription', 'Create Default Subscription')->default(1);

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');

            $form->saved(function (Form $form) {
                $roleModel = config('admin.database.roles_model');
                $permModel = config('admin.database.permissions_model');

                $roleId = $roleModel::whereSlug('manager_copier_subscriptions')->first()->id;

                $user = User::find($form->user_id);
                $user->roles()->syncWithoutDetaching([$roleId]);

                $roleId = $roleModel::whereSlug('user_copier_subscriptions')->first()->id;
                $user->roles()->detach([$roleId]);

                $permId = $permModel::whereSlug('mng.direct_copier')->first()->id;
                $user->permissions()->syncWithoutDetaching([$permId]);

                $permId = $permModel::whereSlug('mng.broker_servers')->first()->id;
                $user->permissions()->syncWithoutDetaching([$permId]);

                if($form->create_default_subscription == 'on' && !CopierSubscription::where('manager_id', $form->user_id )->exists())  {
                    $s = new CopierSubscription();
                    $s->scope_key = $form->user_id;
                    $s->manager_Id = $form->user_id;
                    $s->creator_Id = Admin::user()->id;
                    $s->title = 'My Copier';
                    $s->risk_type = CopierRiskType::RISK_PERCENT;
                    $s->max_risk = 3;
                    $s->save();
                }

            });

        });
    }

}
