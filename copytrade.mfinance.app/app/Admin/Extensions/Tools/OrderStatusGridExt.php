<?php

namespace App\Admin\Extensions\Tools;

use App\Models\OrderStatus;
use Encore\Admin\Admin;
use Encore\Admin\Grid\Tools\AbstractTool;
use Illuminate\Support\Facades\Request;

class OrderStatusGridExt extends AbstractTool
{
    public function script()
    {
        $url = Request::fullUrlWithQuery(['order_status' => '_order_status_']);

        return <<<EOT

$('input:radio.order-status').change(function () {

    var url = "$url".replace('_order_status_', $(this).val());

    $.pjax({container:'#pjax-container', url: url });

});

EOT;
    }

    public function render()
    {
        Admin::script($this->script());

        $options = [
            OrderStatus::OPEN       => OrderStatus::title(OrderStatus::OPEN),
            OrderStatus::CLOSED     => OrderStatus::title(OrderStatus::CLOSED),
            OrderStatus::NOT_FILLED => OrderStatus::title(OrderStatus::NOT_FILLED)
        ];

        return view('admin.tools.order_status', compact('options'));
    }
}
