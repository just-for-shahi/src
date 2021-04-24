<?php

use App\Admin\Actions;
use App\Admin\Extensions\Nav;
use Encore\Admin\Grid\Column;
use App\Admin\Extensions\Tools\Checkboxe;

/**
 * Laravel-admin - admin builder based on Laravel.
 * @author z-song <https://github.com/z-song>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 * Encore\Admin\Form::forget(['map', 'editor']);
 *
 * Or extend custom form field:
 * Encore\Admin\Form::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 *
 */

Encore\Admin\Form::forget(['map', 'editor']);
Column::extend('checkboxe', Checkboxe::class);

Admin::navbar(function (\Encore\Admin\Widgets\Navbar $navbar) {
    app('impersonate')->isActive() && $navbar->right(Nav\Link::make('Deimpersonate', 'user/deimpersonate?redirect_to=/users'));

    auth('admin')->user() && auth('admin')->user()->isAdministrator() && $navbar->left(new Nav\Dropdown());
    //$navbar->right(Nav\Link::make('New Member', 'forms/settings'));
    auth('admin')->user() && auth('admin')->user()->can('mng.product_members')  && $navbar->right(new Actions\NewMember());
    // $navbar->right(new Nav\AutoRefresh())
    //     ->right(new Actions\ClearCache())
    //     ->right(new Actions\Feedback())
    //     ->right(new Actions\System());
});
