<?php

namespace App\Models;

class OrderType
{
    const BUY = 0;
    const SELL = 1;
    const BALANCE = 6;

    /**
     * @param $type
     * @return string
     */
    public static function title($type)
    {
        switch ($type) {
        case self::BUY:
          return 'Buy';
        case self::SELL:
          return 'Sell';
          case self::BALANCE:
              return 'Balance';
        default:
          return $type;
      }
    }

    /**
     * @return array
     */
    public static function marketTypes()
    {
        return [self::BUY, self::SELL];
    }

    public static function countableTypes()
    {
        return [self::BUY, self::SELL, self::BALANCE];
    }
}
