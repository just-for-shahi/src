<?php


namespace App\Facades\HResponse;


use Illuminate\Support\Facades\Facade;

class HResponseFacade extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'HResponse';
    }

}