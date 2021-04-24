<?php

namespace App\Admin\Controllers;

use App\Models\Campaign;

use App\Models\Licensing;
use App\Models\LicensingUser;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Auth;

class LicensingUserController extends AdminController
{
    protected function title() {
        return trans('admin.my_users');
    }

    protected function details($id)
    {
        $show = new Show(Licensing::findOrFail($id));

        $show->id('ID');
        $show->user()->name('Name');
        $show->user()->email('Email');
        $show->user()->created_at('Created');
        $show->user()->updated_at('Updated');

        $show->accounts('Accounts', function ($account) {
            $account->resource('/laccounts');

            $account->account_number('Account');
            $account->stat()->name('Name');
            $account->broker_server_name('Broker');
            $account->stat()->balance('Balance');
            $account->created_at('Created');
            $account->updated_at('Created');
        });

        return $show;
    }

    protected function grid()
    {
        return new Grid(new LicensingUser(), function (Grid $grid) {
            $grid->model()
                ->with('licensing')
                ->with('campaign')
                ->where('manager_id', Auth::guard('admin')->user()->id);

            $grid->id('ID');
            $grid->email('Email');
            $grid->name('Name');
            $grid->note('Note');
            //$grid->column('campaign.title','Campaign')->limit(10);
            //$grid->column('licensing.campaign_id','Campaign')->limit(10);

            $grid->created_at()->sortable();
            $grid->updated_at();

            $grid->filter(function ($filter) {
                $filter->like('email');
                $filter->like('name');
                $filter->like('note');
                $filter->disableIdFilter();
            });

            $grid->tools(function ($tools) {
                $tools->disableRefreshButton();
            });

            $grid->actions(function ($actions) {
                $actions->disableView();
            });

            $grid->rows(function (Grid\Row $row) {
                // $campaign = Campaign::find($row->licensing['campaign_id']);

                // if($campaign)
                //     $row->column('licensing.campaign_id', $campaign->title);
                // else
                //     $row->column('licensing.campaign_id', '');
            });
        });
    }

    protected function form()
    {
        return new Form(new LicensingUser(), function (Form $form) {

            $form->display('id', 'ID');
            $form->hidden('manager_id')->value(Auth::guard('admin')->user()->id);
            $form->hidden('username');
            $form->hidden('password');

            $form->email('email', 'Email')
                ->creationRules(['required', "unique:admin_users"])
                ->updateRules(['required', "unique:admin_users,email,{{id}}"]);

            $form->text('name', 'User Name')->rules('required');
            $form->textarea('note', 'Note');

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');

            $form->disableViewCheck();
            $form->disableEditingCheck();
            $form->disableCreatingCheck();
            $form->tools(function (Form\Tools $tools) {
                $tools->disableView();
            });

            $form->saving(function (Form $form) {
                $form->password = bcrypt($form->email);
                $form->username = $form->email;
            });
        });
    }

}