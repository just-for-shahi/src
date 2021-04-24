<?php

namespace app\Enums\Transaction;

abstract class Recurring
{
    const DISABLED = 0;
    const MONTHLY = 1;
    const QUARTERLY = 2;
    const BIANNUALLY = 3;
    const ANNUALLY = 4;
    const WEEKLY = 5;
    const DAILY = 6;
}
