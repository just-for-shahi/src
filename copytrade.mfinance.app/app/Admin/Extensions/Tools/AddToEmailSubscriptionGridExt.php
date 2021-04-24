<?php

namespace App\Admin\Extensions\Tools;

use Encore\Admin\Admin;
use Encore\Admin\Grid\Tools\AbstractTool;
use Illuminate\Support\Facades\Request;
use App\Admin\Extensions\Tools\AddToSubscriptionAction;
use Illuminate\Support\Collection;

class AddToEmailSubscriptionGridExt extends AbstractTool
{
    protected $subscriptions;

    public function __construct()
    {
        $this->subscriptions = new Collection();
    }

    public function add($abstract)
    {
        $this->subscriptions->push($abstract);

        return $this;
    }

    public function render()
    {
        foreach ($this->subscriptions as $subscription) {
            $subscription->setResource($this->grid->resource());
            Admin::script($subscription->script());
        }

        return view('admin.tools.add2email_subscription', ['subscriptions' => $this->subscriptions]);
    }
}
