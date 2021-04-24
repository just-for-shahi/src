<?php


namespace App\Facades\Rest;


use Illuminate\Support\Facades\Facade;

class RestFacade extends Facade
{

    public static function getFacadeAccessor()
    {
        return 'Rest';
    }
}
