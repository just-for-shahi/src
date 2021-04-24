<?php

namespace App\Models;

class CopierOrderType
{
    const BOTH = 0;
    const LONG_ONLY = 1;
    const SHORT_ONLY = 2;

    public static function title($type)
    {
        switch ($type) {
          case CopierOrderType::BOTH:
            return 'Both';
          case CopierOrderType::LONG_ONLY:
            return 'Long Only';
          case CopierOrderType::SHORT_ONLY:
            return 'Short Only';
        }

        return $type;
    }
}
