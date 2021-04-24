<?php


namespace App\Helpers\Finance;


use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Carbon\Carbon;

class PlusHelper
{

    public static function prices($p){
        switch (intval($p)){
            case 0:
            default:
                return 29900;
                break;
            case 1:
                return 84900;
                break;
            case 2:
                return 169000;
                break;
            case 3:
                return 279000;
                break;
        }
    }

    public static function updatePeriod($c, $d){
        try{
            switch (intval($d)){
                case 0:
                default:
                    return Carbon::parse($c)->addDays(30);
                    break;
                case 1:
                    return Carbon::parse($c)->addDays(90);
                    break;
                case 2:
                    return Carbon::parse($c)->addDays(180);
                    break;
                case 3:
                    return Carbon::parse($c)->addDays(365);
                    break;
            }
        }catch (\Exception $e){
            Bugsnag::notifyException($e);
            return false;
        }
    }

    public static function index($p){
        switch (intval($p)){
            case 29900:
            default:
                return 0;
                break;
            case 84900:
                return 1;
                break;
            case 169000:
                return 2;
                break;
            case 279000:
                return 3;
                break;
        }
    }

}