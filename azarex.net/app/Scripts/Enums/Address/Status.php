<?php


namespace App\Scripts\Enums\Address;


use App\Scripts\Abstracts\EnumMapper;

class Status
{
    use EnumMapper;
    public const WAITING = 0;
    public const CONFIRMED = 1;
    public const REJECTED = 2;

    public static function map(): array
    {
        return [
            self::WAITING => 'در حال انتظار',
            self::CONFIRMED => 'تایید شده',
            self::REJECTED => 'رد شده',
        ];
    }
}
