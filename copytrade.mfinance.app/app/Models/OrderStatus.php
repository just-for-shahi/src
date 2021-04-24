<?php

namespace App\Models;

class OrderStatus
{
    const NOT_FILLED = 0;
    const OPEN = 1;
    const UPDATED = 2;
    const CLOSED = 3;

    public static function title($status)
    {
        switch ($status) {
        case OrderStatus::UPDATED:
        case OrderStatus::OPEN:
          return 'Open';
        case OrderStatus::CLOSED:
          return 'Closed';
        case OrderStatus::NOT_FILLED:
          return 'NotFilled';
        default:
          return 'Unknown';
      }
    }
}
