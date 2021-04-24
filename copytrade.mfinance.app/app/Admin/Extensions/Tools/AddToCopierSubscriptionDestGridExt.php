<?php

namespace App\Admin\Extensions\Tools;

use Encore\Admin\Admin;
use Encore\Admin\Grid\Tools\AbstractTool;
use Illuminate\Support\Facades\Request;
use App\Admin\Extensions\Tools\AddTocopierAction;
use Illuminate\Support\Collection;

class AddToCopierSubscriptionDestGridExt extends AbstractTool
{
    protected $copiers;

    public function __construct()
    {
        $this->copiers = new Collection();
    }

    public function add($abstract)
    {
        $this->copiers->push($abstract);

        return $this;
    }

    public function render()
    {
        foreach ($this->copiers as $copier) {
            $copier->setResource($this->grid->resource());
            Admin::script($copier->script());
        }

        return view('admin.tools.add2copier', ['copiers' => $this->copiers]);
    }
}
