<?php


namespace App\Helpers;


class CallRequestHelper
{

    public static function status($status){
        switch (intval($status)){
            case 0:
                return '<span class="status-pending">درحال‌رسیدگی</span>';
                break;
            case 1:
                return '<span class="status-success">تماس گرفته‌شده</span>';
                break;
            case 2:
                return '<span class="status-pending">در حال انجام</span>';
                break;
            case 3:
                return '<span class="status-reject">لغو شده</span>';
                break;
            default:
                return '<span class="status-reject">خطای‌سیستمی</span>';
                break;
        }
    }

}
