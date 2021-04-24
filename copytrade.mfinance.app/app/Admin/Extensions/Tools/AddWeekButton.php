<?php

namespace App\Admin\Extensions\Tools;

use Encore\Admin\Grid\Tools\AbstractTool;
use Encore\Admin\Grid;

class AddWeekButton extends AbstractTool
{
    const TYPE_NEXT_WEEK = 'next';
    const TYPE_PREV_WEEK = 'prev';

    public $time;
    public $type;

    public function __construct(Grid $grid, $type = self::TYPE_NEXT_WEEK, $date = null)
    {
        $this->grid = $grid;
        if (!$date) {
            $this->time = time();
        } else {
            $this->time = strtotime($date);
        }

        $this->type = $type;
    }

    public function render()
    {
        if (self::TYPE_NEXT_WEEK == $this->type) {
            $offset = '+1 week';
        } else {
            $offset = '-1 week';
        }

        $offsetTime = strtotime($offset, $this->time);
        $yearWeek = date("o_W", $offsetTime);
        $yearMonthWeek = date("M Y", $offsetTime) . ', W' . $this->weekOfMonth($offsetTime);

        if (self::TYPE_NEXT_WEEK == $this->type) {
            $name = 'Next Week    ' . $yearMonthWeek;
            $class = "fa fa-arrow-right";
            $class2 = 'right';
        } else {
            $name = $yearMonthWeek . '    Previous week';
            $class = "fa fa-arrow-left";
            $class2 = 'left';
        }



        //$url = action('UserController@profile', ['id' => 1]);


        return <<<EOT
<div class="btn-group pull-{$class2}" style="margin-right: 10px">
    <a href="{$this->grid->resource()}?&yearweek={$yearWeek}" class="btn btn-sm btn-success">
        <i class="{$class}"></i>&nbsp;&nbsp;{$name}
    </a>
</div>

EOT;
    }

    protected function weekOfMonth($date)
    {
        //Get the first day of the month.
        $firstOfMonth = strtotime(date("Y-m-01", $date));
        //Apply above formula.
        return intval(date("W", $date)) - intval(date("W", $firstOfMonth)) + 1;
    }
}
