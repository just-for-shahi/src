<?php


namespace App\Helpers\Investment;


use App\Enums\Branch\Service;
use App\Scripts\Abstracts\EnumMapper;

class Type
{
    use EnumMapper;

    public static function map(): array
    {
        return [
            Service::BASE => 'Base',
            Service::PLUS => 'Plus',
            Service::ADMIN => 'Admin',
            Service::UACCOUNT => 'UAccount',
        ];
    }

    public static function type($key)
    {
        return self::valueOf($key);
    }

}
