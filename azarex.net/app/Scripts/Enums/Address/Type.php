<?php


namespace App\Scripts\Enums\Address;


use App\Scripts\Abstracts\EnumMapper;

class Type
{
    use EnumMapper;

    public const HOME = 0;
    public const OFFICE = 1;
    public const STUDY = 2;

    public static function map(): array
    {
        return [
            self::HOME => 'منزل',
            self::OFFICE => 'محل کار',
            self::STUDY => 'محل تحصیل',
        ];
    }
}
