<?php


namespace App\Helpers;


class WithdrawHelper
{

    public static function status($status){
        switch (intval($status)){
            case 0:
                return '<span class="status-pending">ثبت‌شده</span>';
                break;
            case 1:
                return '<span class="status-pending">درحال رسیدگی</span>';
                break;
            case 2:
                return '<span class="status-success">تسویه‌شده</span>';
                break;
            case 3:
                return '<span class="status-pending">نیاز به هماهنگی</span>';
                break;
            case 4:
                return '<span class="status-reject">منصرف‌شده</span>';
                break;
            case 5:
                return '<span class="status-reject">مشکل‌قانونی</span>';
                break;
            default:
                return '<span class="status-reject">خطای‌سیستمی</span>';
                break;
        }
    }
}
