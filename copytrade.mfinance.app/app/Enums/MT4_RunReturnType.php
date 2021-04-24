<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class MT4_RunReturnType extends Enum
{
    const OK = 0;
    const FAILED_REPEATABLE = 1;
    const FAILED = 2;
    const ACCOUNT_INVALID = 4;
    const FAILED_W_ALERT = 8;
}
