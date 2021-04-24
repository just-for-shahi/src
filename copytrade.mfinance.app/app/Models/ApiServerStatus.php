<?php

namespace App\Models;

class ApiServerStatus
{
    const DOWN = 0;
    const UP = 1;

    public static function title($status)
    {
        switch ($status) {
      case ApiServerStatus::DOWN:
        return 'Down';
      case ApiServerStatus::UP:
        return 'Up';
    }

        return $status;
    }
}
