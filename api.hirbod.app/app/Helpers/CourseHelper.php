<?php


namespace App\Helpers;


class CourseHelper
{
    public static function level($level){
        switch (intval($level)){
            case 0:
                return 'عادی';
                break;
            case 1:
                return 'مقدماتی';
                break;
            case 2:
                return 'پیشرفته';
                break;
            default:
                return 'خطا در تشخیص';
                break;
        }
    }

    public static function status($status){
        switch (intval($status)){
            case 0:
                return 'منتظر تایید';
                break;
            case 1:
                return 'منتشر شده';
                break;
            case 2:
                return 'تعلیق شده';
                break;
            case 3:
                return 'رد شده';
                break;
            case 4:
                return 'کمیته فیلترینگ';
                break;
            default:
                return 'خطا در تشخیص';
                break;
        }
    }

}