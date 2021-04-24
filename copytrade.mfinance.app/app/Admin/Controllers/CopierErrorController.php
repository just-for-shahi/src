<?php

namespace App\Admin\Controllers;

use App\Models\Account;
use App\Models\Order;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Grid;

class CopierErrorController extends AdminController
{

    protected function title() {
        return __('admin.copier_errors');
    }

    protected function grid()
    {
        return new Grid( new Order(), function (Grid $grid) {

            $grid->model()
                ->where('ticket', '<', 0)
                ->whereHas('account', function ($q) {
                    $q->whereUserId(Admin::user()->id);
                })
                ->orderBy('time_created', 'DESC');

            $grid->time_created('Time')->sortable();
            $grid->account_number('Account');
            $grid->last_error('Last Error');

            $grid->filter(function ($filter) {
                $filter->between('time_created', 'Time')->datetime();
                $filter->equal('account_number', 'Account')
                    ->select(Account::whereUserId(Admin::user()->id)->pluck('account_number','account_number'));
                $filter->like('last_error', 'Last Error');
                $filter->disableIdFilter();
            });

            $grid->expandFilter();
            $grid->disableCreateButton();
            $grid->disableExport();
            $grid->disableActions();
        });
    }

}
