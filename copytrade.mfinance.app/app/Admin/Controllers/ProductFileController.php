<?php

namespace App\Admin\Controllers;

use App\Models\ProductFile;
use App\Models\Product;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Illuminate\Support\Facades\Auth;
use Encore\Admin\Layout\Content;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;

class ProductFileController extends Controller
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
            $content->header('Files');
            $content->description('Manage Files');

            $content->body($this->grid());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(ProductFile::class, function (Grid $grid) {
            $grid->paginate(5);
            $grid->model()->whereHas('product', function($q) { $q->whereManagerId(Admin::user()->id);});

            $grid->product()->title('Product')->badge('blue');
            $grid->path('File')->downloadable();
            $grid->type('Type')->sortable();

            $grid->created_at();
            $grid->updated_at();

            $grid->filter(function ($filter) {
                $filter->equal('product_id', 'Product')->select(Product::whereManagerId(Auth('admin')->user()->id)->pluck('title', 'id'));
                $filter->like('name');
                $filter->disableIdFilter();
            });
            $grid->actions(function ($actions) {
                $actions->disableView();
            });
            $grid->rows(function ($row) {
            });
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
            $content->header('File');
            $content->description('Edit File');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(ProductFile::class, function (Form $form) {
            $form->display('id', 'ID');
            $products = Product::whereManagerId(Admin::user()->id)->pluck('title', 'id');
            $def = Request::get('product_id');
            $form->select('product_id', 'Product')->options($products)->default($def)->required();

            if ($form->isEditing()) {
                $form->display('name', 'Name');
            }

            if($form->isCreating())
                $form->file('path', __('File'))->required();
            else
                $form->file('path', __('File'));


            $form->select('type', 'Type')->options(['Indicator'=>'Indicator','Expert'=>'Expert','File'=>'File'])->required();
            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');

            $form->saving(function ($form) {
                if (!is_null($form->path)) {
                    $form->model()->name = $form->path->getClientOriginalName();
                }
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
            $content->header('File');
            $content->description('File');

            $content->body($this->form());
        });
    }
}
