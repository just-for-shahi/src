<?php

namespace App\Admin\Controllers;

use App\Models\Tag;

use App\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;

class ColoredTagController extends AdminController
{
    protected function title() {
        return trans('admin.colored_tags');
    }

    protected function grid()
    {
        return new Grid( new Tag(), function (Grid $grid) {

            $grid->model()->whereManagerId(Admin::user()->id);

            $grid->id('ID')->sortable();
            $grid->title('Title')->editable();
            $grid->color('Color')->display(function($color) {
                return "<span class='label' style='background-color:{$color}'>&nbsp;&nbsp;</span>";
            });

            $states = [
                '1' => ['text' => 'Yes'],
                '0' => ['text' => 'No'],
            ];
            $grid->enabled('Enabled')->switch($states)->sortable();

            $grid->filter(function ($filter) {
                $filter->like('title');
                $filter->disableIdFilter();
            });

            $grid->actions(function ($actions) {
                $actions->disableView();
            });

            $grid->rows(function ($row) {
            });
        });
    }

    protected function form()
    {
        return new Form( new Tag(), function (Form $form) {
            $form->hidden('manager_id')->value(Admin::user()->id);

            $form->display('id', 'ID');

            $form->text('title', 'Title')->required();
            $form->color('color', 'Color');
            $form->switch('enabled', 'Enabled?')->default(1);

            $form->disableViewCheck();
            $form->disableEditingCheck();
            $form->disableCreatingCheck();
            $form->tools(function (Form\Tools $tools) {
                $tools->disableView();
            });
        });
    }
}
