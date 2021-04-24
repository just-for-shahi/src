<?php


namespace App\Scripts\Abstracts;

/**
 * @author amirhs712
 * Trait EnumMapper
 * @package App\Scripts\Abstracts
 */
trait EnumMapper
{
    public static function map() : array{
        return [

        ];
    }

    public static function isMapped()
    {
        return true;
    }

    public static function all()
    {
        if (self::isMapped()) {
            return array_keys(self::map());
        }

        return self::map();
    }

    public static function valueOf($key)
    {
        return self::map()[$key];
    }
}
