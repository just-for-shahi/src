<?php


namespace App\Facades\Persian;


use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Morilog\Jalali\Jalalian;

class Persian
{

    public static function datetime($datetime){
        try{
            return Jalalian::forge($datetime)->format(config('mehrino.datetime'));
        }catch (\Exception $e){
            Bugsnag::notifyException($e);
            return null;
        }
    }
    public static function format($datetime,$format="h:s Y/m/d"){
        try{
            return Jalalian::forge($datetime)->format($format);
        }catch (\Exception $e){
            Bugsnag::notifyException($e);
            return null;
        }
    }
}
