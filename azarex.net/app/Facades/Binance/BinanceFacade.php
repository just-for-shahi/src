<?php


namespace App\Facades\Binance;


use Illuminate\Support\Facades\Facade;

class BinanceFacade extends Facade
{

    public static function getFacadeAccessor()
    {
        return 'Binance';
    }
}
