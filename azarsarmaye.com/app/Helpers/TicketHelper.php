<?php

namespace App\Helpers;


class TicketHelper
{
    public static function status($status){
        switch (intval($status)){
            case 0:
                return '<span class="status-pending">منتظررسیدگی</span>';
                break;
            case 1:
                return '<span class="status-success">رسیدگی‌شده</span>';
                break;
            case 2:
                return '<span class="status-success">منتظررسیدگی</span>';
                break;
            case 3:
                return '<span class="status-reject">بایگانی‌شده</span>';
                break;
            case 4:
                return '<span class="status-reject">لغو‌شده</span>';
                break;
            default:
                return '<span class="status-reject">خطای‌سیستمی</span>';
                break;
        }
    }

    public static function statusTextly($status){
        switch (intval($status)){
            case 0:
            case 2:
                return 'منتظربررسی';
                break;
            case 1:
                return 'منتظرمشتری';
                break;
            case 3:
                return 'بایگانی';
                break;
            case 4:
                return 'بسته';
                break;
            default:
                return 'خطا';
                break;
        }
    }

    public static function priority($priority){
        switch (intval($priority)){
            case 0:
                return 'عادی';
                break;
            case 1:
                return 'کم اهمیت';
                break;
            case 2:
                return 'مهم و فوری';
                break;
            default:
                return 'خطا در تشخیص';
                break;
        }
    }

    public static function department($dep){
        switch (intval($dep)){
            case 0:
                return 'عمومی';
                break;
            case 1:
                return 'حساب مالی';
                break;
            case 2:
                return 'سرمایه گذاری';
                break;
            case 3:
                return 'همکاری و مدیریت';
                break;
            default:
                return 'خطا در تشخیص';
                break;
        }
    }

}
