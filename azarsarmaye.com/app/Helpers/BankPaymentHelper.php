<?php


namespace App\Helpers;


class BankPaymentHelper
{
    public static function status($status){
        switch (intval($status)){
            case 0:
                return '<span class="status-pending">درحال‌رسیدگی</span>';
                break;
            case 1:
                return '<span class="status-success">تاییدشده</span>';
                break;
            case 2:
                return '<span class="status-pending">معلق</span>';
                break;
            case 3:
                return '<span class="status-reject">ردشده</span>';
                break;
            default:
                return '<span class="status-reject">خطای‌سیستمی</span>';
                break;
        }
    }



}
