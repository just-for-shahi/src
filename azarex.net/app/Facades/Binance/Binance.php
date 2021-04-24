<?php


namespace App\Facades\Binance;


use Binance\API;

class Binance
{

    public static function prices(){
        try{
            $api = new API(config('azarex.binance_api_key'), config('azarex.binance_secret_key'));
            return $api->prices();
        }catch (\Exception $e){
            return dd($e->getMessage());
        }
    }

    public static function price($symbol){
        try{
            $api = new API(config('azarex.binance_api_key'), config('azarex.binance_secret_key'));
            $change = $api->prevDay($symbol);
            return ['price' => $api->price($symbol), 'change' => $change['priceChangePercent']];
        }catch (\Exception $e){
            return dd($e->getMessage());
        }
    }

}
