<?php

namespace App\Admin\Controllers;

use App\Models\EmailSubscription;
use App\Models\Account;
use App\Models\CopierType;

use App\Models\Expert;
use App\Models\ExpertSubscription;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

class ExpertSubscriptionController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {
            $content->header('Expert Subscriptions');
            $content->description('');

            $content->body($this->grid());
        });
    }

    protected function grid()
    {
        return Admin::grid(ExpertSubscription::class, function (Grid $grid) {
            $grid->model()->whereManagerId(Auth('admin')->user()->id);

            $grid->id('ID')->sortable();

            $grid->title('Title');

            $grid->experts('Experts')->pluck('name')->label();
            $grid->expire_days('Expire Days');
            $grid->count_templates('#Templates');

            $grid->created_at()->sortable();
            $grid->updated_at();

            $grid->disableExport();
            $grid->disableFilter();
            $grid->actions(function ($actions) {
                $actions->disableView();
            });
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {
            $content->header('Email Subscription');
            $content->description('New Email Subscription');

            $content->body($this->form());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {
            $content->header('Expert Subscription');
            $content->description('Edit Expert Subscription');

            $content->body($this->form()->edit($id));
        });
    }

    protected function form()
    {
        return Admin::form(ExpertSubscription::class, function (Form $form) {
            $form->hidden('manager_id')->value(Auth::guard('admin')->user()->id);
            $form->text('title', 'Title');

            $form->multipleSelect('experts', 'Experts')->options(
                Expert::where([
                    ['manager_id', Auth::guard('admin')->user()->id],
                    ])->pluck('name', 'id')
            );

            $form->number('count_templates', '#Templates')->default(1);
            $form->number('expire_days', '#Days to expire')->default(0);

            $form->switch('enabled', 'Enabled?')->default(1);

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');

            $form->saved(function (Form $form) {
            });
        });
    }
}
