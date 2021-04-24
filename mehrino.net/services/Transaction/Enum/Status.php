<?php


namespace Services\Transaction\Enum;

abstract class Status
{
    const REGISTERED = 0;
    const PAID = 1;
    const FAILED = 2;
    const ADMIN_PAID = 3;
    const PROMOTION = 4;
    const PLUS = 5;
    const COUPON = 6;
}
