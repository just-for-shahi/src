<?php


namespace App\Scripts\Enums\Verification;


use App\Scripts\Abstracts\EnumMapper;

class Type
{
    use EnumMapper;

    public const SHENASNAME = 0;
    public const PASSPORT = 1;
    public const ID_CARD = 2;

    public static function map(): array
    {
        return [
            self::SHENASNAME => 'شناسنامه',
            self::PASSPORT => 'پاسپورت',
            self::ID_CARD => 'کارت ملی',
        ];
    }
}
