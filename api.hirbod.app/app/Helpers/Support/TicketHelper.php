<?php

namespace App\Helpers\Support;


class TicketHelper
{
    public static function status($status){
        switch (intval($status)){
            case 0:
                return '<span class="status-pending">در حال انتظار</span>';
                break;
            case 1:
                return '<span class="status-pending">در حال رسیدگی</span>';
                break;
            case 2:
                return '<span class="status-success">پاسخ داده شده</span>';
                break;
            case 3:
                return '<span class="status-success">بسته شده</span>';
                break;
            default:
                return '<span class="status-reject">خطای‌سیستمی</span>';
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
                return 'مهم';
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
                return 'امورمالی';
                break;
            case 2:
                return 'فنی';
                break;
            case 3:
                return 'کتاب‌ها';
                break;
            case 4:
                return 'پادکست‌ها';
                break;
            case 5:
                return 'مدیریت';
                break;
            default:
                return 'خطای سیستمی';
                break;
        }
    }

}
