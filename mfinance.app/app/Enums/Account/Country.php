<?php

namespace App\Enums\Account;

abstract class Country
{
    public const USA = 0;
    public const IR = 1;

    public const NAME_TO_CODE = [
        'USA' => self::USA,
        'IR' => self::IR
    ];

    public const CODE_TO_NAME = [
        self::USA => 'USA',
        self::IR => 'IR'
    ];

    public static function mapNameToCode($name) {
        return self::NAME_TO_CODE[$name];
    }

    public static function mapCodeToName($code) {
        return self::CODE_TO_NAME[$code];
    }

}
