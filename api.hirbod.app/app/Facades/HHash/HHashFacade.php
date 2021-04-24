<?php


namespace App\Facades\HHash;


use Illuminate\Support\Facades\Facade;

class HHashFacade extends Facade
{

    public static function getFacadeAccessor()
    {
       return 'HHash';
    }
}