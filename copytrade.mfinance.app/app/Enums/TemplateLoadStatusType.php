<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class TemplateLoadStatusType extends Enum
{
    const EMPTY    = 0;
    const LOADED   = 1;
    const FAILED   = 2;
    const WRONG_EA = 3;

    public static function title($type)
    {
        switch ($type) {
            case self::EMPTY:
                return 'Down';
            case self::LOADED:
                return 'Loaded';
            case self::FAILED:
                return 'Failed';
            case self::WRONG_EA:
                return 'WrongEA';                
        }

        return $type;
    }    
}
