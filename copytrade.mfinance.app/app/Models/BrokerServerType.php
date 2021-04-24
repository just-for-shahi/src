<?php

namespace App\Models;

class BrokerServerType
{
    const API = 0;
    const MANAGER = 1;

    public static function title($type)
    {
        switch ($type) {
            case self::API:
                return 'API';
            case self::MANAGER:
                return 'Manager';
            default:
                return $type;
        }
    }
}
