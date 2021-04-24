<?php


namespace App\Helpers;


class EbookHelper
{

    public static function status($status){
        switch (intval($status)){
            case 0:
                return '<span class="status-pending">درحال‌بررسی</span>';
                break;
            case 1:
                return '<span class="status-success">تائیدشده</span>';
                break;
            default:
                return '<span class="status-reject">خطای‌سیستمی</span>';
                break;
        }
    }

}