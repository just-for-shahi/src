<?php

namespace App\Admin\Controllers;

use App\Enums\FileType;

use App\Models\File;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Illuminate\Support\Facades\Auth;

class FileController extends AdminController
{
    protected function title() {
        return trans('admin.files');
    }

    protected function grid()
    {
        return new Grid(new File(), function (Grid $grid) {
            $grid->model()->whereManagerId(Admin::user()->id);

            $grid->id('ID')->sortable();

            $grid->name('Name')->sortable();
            $grid->path('Path')->sortable();
            $grid->type('Type')->sortable();

            $grid->created_at();
            $grid->updated_at();

            $grid->filter(function ($filter) {
                $filter->like('name');
                $filter->like('type');
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
        return new Form(new File(), function (Form $form) {

            $form->hidden('manager_id')->value(Auth::guard('admin')->user()->id);
            $form->display('id', 'ID');

            if ($form->isEditing()) {
                $form->display('name', 'Name');
            }

            $form->file('path', __('File'))->required()->hidePreview();

            $options = [
                FileType::EX4 => FileType::EX4,
                FileType::TPL => FileType::TPL,
                FileType::LIB => FileType::LIB,
                FileType::FILE => FileType::FILE,
                FileType::EXE => FileType::EXE,
            ];

            $form->radio('type', 'Type')->values($options)->default(FileType::EX4);

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');

            $form->saving(function ($form) {
                if (!is_null($form->path)) {
                    $form->model()->name = $form->path->getClientOriginalName();
                    $form->model()->data = $form->path->get();
                    $form->model()->is_updated_or_new = 1;
                }
            });
        });
    }

}
