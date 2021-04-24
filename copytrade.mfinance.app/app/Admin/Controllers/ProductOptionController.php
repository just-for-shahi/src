<?php

namespace App\Admin\Controllers;

use App\Models\Product;

use App\Models\ProductOption;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class ProductOptionController extends AdminController
{

    protected function title() {
        return trans('admin.product_options');
    }

    protected function grid()
    {
        return new Grid(new ProductOption(), function (Grid $grid) {

            //$grid->disableBatchDeletion();
            $grid->model()->with('product')->whereHas('product', function($q) {
                $q->whereManagerId(Admin::user()->id);
            });

            $grid->id('ID')->sortable();
            $grid->product()->title('Product')->badge('blue');
            $grid->pkey('Key');
            $grid->val('Value');

            $states = [
                '1' => ['text' => 'Yes'],
                '0' => ['text' => 'No'],
            ];
            $grid->enabled()->switch()->sortable();

            $grid->created_at();
            $grid->updated_at();

            $grid->filter(function ($filter) {
                $filter->equal('product_id', 'Product')->select(Product::whereManagerId(Auth('admin')->user()->id)->pluck('title', 'id'));
                $filter->disableIdFilter();
            });

            $grid->actions(function ($actions) {
                $actions->disableView();
            });

            $grid->rows(function ($row) {

                // if (Str::contains($row->enabled, 'value="on"')) {
                //     $row->style('color:green');
                // } else {
                //     $row->style('color:red');
                // }
            });
        });
    }

    protected function form()
    {
        return new Form(new ProductOption(), function (Form $form) {
            $form->display('id', 'ID');

            $products = Product::whereManagerId(Admin::user()->id)->pluck('title', 'id');
            $def = Request::get('product_id');
            $form->select('product_id', 'Product')->options($products)->default($def)->required();

            $form->text('pkey', 'Key');
            $form->text('val', 'Value');

            $form->switch('enabled', 'Enabled?')->default(1);

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
