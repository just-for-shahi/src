<?php


namespace App\Facades\HHash;


use Bugsnag\BugsnagLaravel\Facades\Bugsnag;

class HHash
{

    private static $ALGORITHM = 'sha256';
    private static $SECRET = "Drdol UgA9230cqGGZ_hdv54Z۳۴@#ziHi%^%&J4Pxh!@XY453hF۵۴۳SVDSs_Greeکلم۸۹۰نحطی اب هوز ۳۱۲۹۸۷بیسدجد سر کله الخیر۳۴۵ فی ما وق۴۵۴۳ع او ی۲۱۳وقم";
    public static function hash($m){
        try{
            return hash_hmac(self::$ALGORITHM, $m, self::$SECRET, false);
        }catch (\Exception $e){
            Bugsnag::notifyException($e);
            return null;
        }
    }

}