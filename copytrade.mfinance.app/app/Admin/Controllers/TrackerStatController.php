<?php

namespace App\Admin\Controllers;

use PragmaRX\Tracker\Vendor\Laravel\Models\Log;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;

use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;

class TrackerStatController extends Controller
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
            $content->header('Tracker');
            $content->description('Stat');

            $content->body($this->grid());
        });
    }

    protected function grid()
    {
        return Admin::grid(Log::class, function (Grid $grid) {

            $grid->updated_at('At');

            $grid->model()->whereHas('session', function($q) {  $q->whereIsRobot(0);})->orderBy('updated_at', 'DESC');
            //$grid->column('sessiondevice.kind','Device');
            $grid->column('sessionlanguage.preference', 'Lang');
            $grid->column('sessionagent.browser','Agent');
            //$grid->session()->client_ip('IP');
            $grid->column('sessiongeoip.country_code', 'C');
            $grid->column('sessiongeoip.city', 'City');
            //$grid->referer()->host('Host');
            $grid->routePath()->path('Path');
            $grid->column('route.name', 'Name');
            $grid->column('route.action', 'Action');
            $grid->error()->code('ErrCode');
            $grid->error()->message('ErrMsg');

            $grid->disableRowSelector();
            $grid->disableCreation();
            $grid->disableExport();
            $grid->disableActions();

            $grid->filter(function ($filter) {
                $filter->scope('Errors')->whereNotNull('error_id');
                $filter->scope('addedtoday', 'Added today')->whereDate('created_at', date('Y-m-d'));
                $filter->scope('errorsToday', 'Errors today')->whereDate('created_at', date('Y-m-d'))->whereNotNull('error_id')->asDefault();
                $filter->disableIdFilter();
            });

            $grid->hideColumns('sessiongeoip.city');
        });
    }

}
