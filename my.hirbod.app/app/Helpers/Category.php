<?php


namespace App\Helpers;


class Category
{

    public static function type($t){
        try{
            switch (intval($t)){
                default:
                case 0:
                    return 'دوره‌';
                    break;
                case 1:
                    return 'پادکست';
                    break;
                case 2:
                    return 'کتاب';
                    break;
                case 3:
                    return 'رویداد';
                    break;
            }
        }catch(\Exception $e){
            return false;
        }
    }

}
