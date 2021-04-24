<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;

class OrderStateChanged
{
    use SerializesModels;

    public $order;

    public function __construct($order)
    {
        $this->order = $order;
    }
}
