<?php


namespace App\Helpers;


class Podcast
{

    public static function status($s){
        try{
            switch (intval($s)){
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
        }catch (\Exception $e){
            return false;
        }
    }

    public static function episodeStatus($s){
        try{
            switch (intval($s)){
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
        }catch (\Exception $e){
            return false;
        }
    }
}
