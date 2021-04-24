<?php

namespace App\Admin\Controllers;

use App\Models\Product;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Facades\Admin;
use Illuminate\Support\Facades\Auth;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;

class ProductController extends Controller
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
            $content->header('Products');
            $content->description('Manager Products');

            $content->body($this->grid());
        });
    }

    protected function show($id)
    {
        $show = new Show(Product::findOrFail($id));

        $show->key('Key');
        $show->title('Title');

        $show->files('Files', function ($file) {
            $file->resource('/pfiles');

            $file->name('Name');
            $file->path('Download')->downloadable();
        });

        $show->opts('Options', function ($option) {
            $option->resource('/poptions');

            $option->pkey('Key');
            $option->val('Value');
        });

        return $show;
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
            $content->header('Product');
            $content->description('Manage Product');

            $content->body($this->form()->edit($id));
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
            $content->header('Product');
            $content->description('New Product');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Product::class, function (Grid $grid) {

            $grid->disableCreation();
            //$grid->disableRowSelector();
            $grid->model()->whereManagerId(Auth('admin')->user()->id);

            $grid->id('ID')->sortable();
            $grid->key('Key');
            $grid->title('Title')->badge('blue');
            $grid->version('Version');

            //$grid->column('Opts');
            //$grid->column('Files');

            $grid->created_at('Created');
            $grid->updated_at('Updated');

            $grid->filter(function ($filter) {
                $filter->disableIdFilter();
            });

            $grid->actions(function ($actions) {
                //$actions->disableView();
                $actions->disableDelete();
            });

            $grid->rows(function ($row) {
                $row->column('Opts', "<a href='poptions?product_id={$row->id}'>Options</a>");
                $row->column('Files', "<a href='pfiles?product_id={$row->id}'>Files</a>");
            });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Product::class, function (Form $form) {
            $form->hidden('manager_id')->value(Auth::guard('admin')->user()->id);

            $form->display('id', 'ID');

            if ($form->isEditing()) {
                $form->display('key', 'Key');
            } else {
                $form->text('Key', 'Key');
            }

            $form->text('version', 'Version');
            $form->text('title', 'Title');
            $form->textarea('description', 'Description');

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
