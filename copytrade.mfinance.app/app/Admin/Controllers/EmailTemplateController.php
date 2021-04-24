<?php

namespace App\Admin\Controllers;

use App\Models\ManagerMailTemplate;
use Carbon\Carbon;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Illuminate\Support\Facades\Auth;

class EmailTemplateController extends AdminController
{
    protected function title() {
        return trans('admin.email_templates');
    }

    protected function grid()
    {
        return new Grid(new ManagerMailTemplate(), function (Grid $grid) {
            $grid->model()->whereManagerId(Admin::user()->id);

            $grid->id('ID');

            $grid->mailable('Type');
            $grid->tag('Tag');
            $grid->subject('Subject Template');

            $grid->updated_at('Updated')->display(function ($updated_at) {
                return Carbon::parse($updated_at)->diffForHumans();
            });

            $grid->rows(function (Grid\Row $row) {
            });

            $grid->filter(function ($filter) {
                $filter->like('subject');
                $filter->disableIdFilter();
            });
            //$grid->disableCreateButton();
            $grid->disableExport();
            $grid->actions(function ($actions) {
                $actions->disableView();
                $actions->disableDelete();
            });
        });
    }

    protected function form()
    {
        return new Form(new ManagerMailTemplate(), function (Form $form) {

            $form->display('id', 'ID');
            $form->hidden('manager_id')->value(Auth::guard('admin')->user()->id);

            if ($form->isEditing()) {
                $form->text('mailable', 'Type')->disable();
            } else {
                $options = ['App\Mail\LicenseMail' => 'App\Mail\LicenseMail'];
                $def = 'App\Mail\LicenseMail';
                $form->select('mailable', 'Type')->options($options)->default($def)->required();
            }
            $form->text('tag', 'Title')->required();

            $form->text('subject', 'Subject')->required();
            $form->tinymce('html_template', 'Html Template')->required();
            $form->textarea('text_template', 'Text Template');

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
