<?php


namespace App\Enums;


abstract class Transaction
{

    // WITHDRAW
    public const WITHDRAW = 0;
    public const DEPOSIT = 1;

    // TYPE
    public const EXCHANGE = 0;
    public const SUBSCRIPTION = 1;
    public const PAYMENT = 2;
    public const INVESTMENT = 3;
    public const CHARITY = 4;

    // STATUS
    public const SUCCESSFUL = 0;
    public const UNSUCCESSFUL = 1;
    public const SUSPENDED = 2;
    public const DEPOSITED = 3;
    public const REJECTED = 4;
    public const WORKING_ON_IT = 5;
    public const PAID_AND_SUSPENDED  = 6;
    public const REFUNDED_AND_SUSPENDED = 7;
    public const REFUNDED = 8;
    public const PAID = 9;

    public static function statusHTML($status){
        $statuses = [
            '0' => '<span class="label label-lg font-weight-bold label-light-info label-inline">در انتظار تایید</span>'
        ];
        return $statuses[$status];
    }

    public static function persianMap($status)
    {
        $map = [
            self::SUCCESSFUL => 'موفق',
            self::UNSUCCESSFUL => 'ناموفق',
            self::SUSPENDED => 'معلق',
            self::DEPOSITED => 'واریز شده',
            self::REJECTED => 'رد شده',
            self::WORKING_ON_IT => 'در دست اقدام',
            self::PAID_AND_SUSPENDED => 'پرداخت شده و معلق',
            self::REFUNDED_AND_SUSPENDED => 'عودت شده و معلق',
            self::REFUNDED => 'عودت',
            self::PAID => 'پرداخت شده'
        ];

        return $map[$status];
    }


    public static function persianMap2(int $type)
    {
        $map = [
            self::WITHDRAW => 'برداشت',
            self::DEPOSIT => 'واریز'
        ];

        return $map[$type];
    }


}
