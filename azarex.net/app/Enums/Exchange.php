<?php


namespace App\Enums;


abstract class Exchange
{

    // CURRENCY
    public const USDT = 0;
    public const BTC = 1;
    public const ETH = 2;
    public const LTC = 3;
    public const DOGE = 4;
    public const AZR = 5;

    // TYPE
    public const BUY = 0;
    public const SELL = 1;

    // STATUS
    public const WAITING = 0;
    public const UNSUCCESSFUL = 1;
    public const SUSPENDED = 2;
    public const DEPOSITED = 3;
    public const REJECTED = 4;
    public const WORKING_ON_IT = 5;
    public const PAID_AND_SUSPENDED  = 6;
    public const REFUNDED_AND_SUSPENDED = 7;
    public const REFUNDED = 8;
    public const DONE = 9;

    public static function htmlStatus($status){
        $statuses = [
            '0' => '<span class="label label-lg label-warning font-weight-bold label-light-info label-inline">در انتظار تایید</span>',
            '1' => '<span class="label label-lg label-danger font-weight-bold label-light-info label-inline">ناموفق</span>',
            '2' => '<span class="label label-lg label-danger font-weight-bold label-light-info label-inline">مسدود شده</span>',
            '3' => '<span class="label label-lg label-primary font-weight-bold label-light-info label-inline">پرداخت شده</span>',
            '4' => '<span class="label label-lg label-danger font-weight-bold label-light-info label-inline">معلق شده</span>',
            '5' => '<span class="label label-lg label-warning font-weight-bold label-light-info label-inline">در حال پردازش</span>',
            '6' => '<span class="label label-lg label-danger font-weight-bold label-light-info label-inline">معلق شده</span>',
            '7' => '<span class="label label-lg label-danger font-weight-bold label-light-info label-inline">معلق شده</span>',
            '8' => '<span class="label label-lg label-primary font-weight-bold label-light-info label-inline">بازپرداخت شده</span>',
            '9' => '<span class="label label-lg label-success font-weight-bold label-light-info label-inline">انجام شده</span>',
        ];
        return $statuses[$status];
    }

    public static function htmlType($type){
        $types = [
            '0' => '<span class="label label-danger label-dot mr-2"></span><span class="text-danger">فروش</span>',
            '1' => '<span class="label label-primary label-dot mr-2"></span><span class="text-primary">خرید</span>',
        ];
        return $types[$type];
    }

    public static function htmlCurrency($currency){
        $currencies = [
            '0' => '<span>تتر</span>',
            '1' => '<span>بیت‌کوین</span>',
            '2' => '<span>اتریوم</span>',
            '3' => '<span>لایت کوین</span>',
            '4' => '<span>دوج کوین</span>',
            '5' => '<span>توکن آذر</span>',
        ];
        return $currencies[$currency];
    }

}
