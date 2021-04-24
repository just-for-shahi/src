<?php

namespace App\Models;

class CopierDirection
{
    const NORMAL = 0;
    const INVERSE = 1;

    public static function title($direction)
    {
        switch ($direction) {
      case CopierDirection::NORMAL:
        return 'Normal';
      case CopierDirection::INVERSE:
        return 'Inverse';
    }

        return $direction;
    }
}
