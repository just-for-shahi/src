<?php


namespace App\Helpers;


use App\Models\User;

class UserHelper
{

    public static function status($status){
        switch (intval($status)){
            case 0:
                return 'ثبت‌نام';
                break;
            case 1:
                return 'تایید شده';
                break;
            case 2:
                return 'VIP';
                break;
            case 3:
                return 'تعلیق';
                break;
            case 4:
                return 'مسدود شده';
                break;
            default:
                return 'خطای سیستمی';
                break;
        }
    }

    public static function summary($user){
        $user = User::find($user);
        return $user['name'].'-'.$user['mobile'];
    }
}
