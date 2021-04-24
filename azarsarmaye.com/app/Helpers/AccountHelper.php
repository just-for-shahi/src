<?php


namespace App\Helpers;


use App\Models\Account;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;

class AccountHelper
{
    public static function type($type)
    {
        switch (intval($type)) {
            case 0:
                return 'ماهیانه 15%';
                break;
            case 1:
                return 'ماهیانه 20%';
                break;
            default:
                return 'خطا در سیستم';
                break;
        }
    }

    public static function plan($plan)
    {
        switch (intval($plan)) {
            case 0:
                return 'سارینا';
                break;
            case 1:
                return 'ماهینا';
                break;
            default:
                return 'خطا در سیستم';
                break;
        }
    }

    public static function status($status)
    {
        switch (intval($status)) {
            case 0:
                return '<span class="status-success">تائید شده</span>';
                break;
            case 1:
                return '<span class="status-pending">در حال بررسی</span>';
                break;
            case 2:
                return '<span class="status-reject">مسدود</span>';
                break;
            case 4:
                return '<span class="status-reject">مشکل قانونی</span>';
                break;
            default:
                return '<span class="status-reject">خطای سیستمی</span>';
                break;
        }
    }

    public static function summary($account)
    {
        try {
            if (!$account) {
                return null;
            }
            $account = Account::find($account);
            return "شماره حساب: " . $account->no . " / قابل برداشت: " . number_format($account->harvestable);
        } catch (\Exception $e) {
            Bugsnag::notifyException($e);
            return 'خطای سیستمی';
        }
    }

    public static function investmentStatus($status)
    {
        switch (intval($status)) {
            case 0:
                return '<span class="status-pending">منتظر پرداخت</span>';
                break;
            case 1:
                return '<span class="status-success">فعال</span>';
                break;
            case 2:
                return '<span class="status-pending">در دست رسیدگی</span>';
                break;
            case 3:
                return '<span class="status-reject">تسویه شده</span>';
                break;
            default:
                return '<span class="status-reject">خطای سیستمی</span>';
                break;
        }
    }

    public static function no()
    {
        return random_int(10000, 99999999);
    }

    public static function color($c)
    {
        switch (intval($c)) {
            default:
            case 0:
                return '#D50000';
                break;
            case 1:
                return '#2962FF';
                break;
            case 2:
                return '#00C853';
                break;
            case 3:
                return '#FFD600';
                break;
            case 4:
                return '#FF6D00';
                break;
            case 5:
                return '#1A237E';
                break;
        }
    }

    public static function hex2RGB($hexStr, $returnAsString = false, $seperator = ',')
    {
        $hexStr = preg_replace("/[^0-9A-Fa-f]/", '', $hexStr); // Gets a proper hex string
        $rgbArray = array();
        if (strlen($hexStr) == 6) { //If a proper hex code, convert using bitwise operation. No overhead... faster
            $colorVal = hexdec($hexStr);
            $rgbArray['red'] = 0xFF & ($colorVal >> 0x10);
            $rgbArray['green'] = 0xFF & ($colorVal >> 0x8);
            $rgbArray['blue'] = 0xFF & $colorVal;
        } elseif (strlen($hexStr) == 3) { //if shorthand notation, need some string manipulations
            $rgbArray['red'] = hexdec(str_repeat(substr($hexStr, 0, 1), 2));
            $rgbArray['green'] = hexdec(str_repeat(substr($hexStr, 1, 1), 2));
            $rgbArray['blue'] = hexdec(str_repeat(substr($hexStr, 2, 1), 2));
        } else {
            return false; //Invalid hex color code
        }
        return $returnAsString ? implode($seperator, $rgbArray) : $rgbArray; // returns the rgb string or the associative array
    }

}
