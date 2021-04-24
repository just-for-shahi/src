<?php


namespace App\Http\Controllers;


use App\Facades\Binance\Binance;
use Binance\API;

class PagesController extends Controller
{

    public function index(){
        $btcPrice = Binance::price('BTCUSDT');
        $ethPrice = Binance::price('ETHUSDT');
        $ltcPrice = Binance::price('LTCUSDT');
        $zecPrice = Binance::price('ZECUSDT');
        $xmrPrice = Binance::price('XMRUSDT');
        $azrPrice = config('azarex.azr.price');
        return view('index', compact('btcPrice', 'ethPrice', 'ltcPrice', 'zecPrice', 'xmrPrice', 'azrPrice'));
    }

    public function contact(){
        return view('pages.contact');
    }

    public function about(){
        return view('pages.about');
    }

    public function pricing(){
        return view('pages.pricing');
    }

    public function privacy(){
        return view('pages.privacy');
    }

    public function terms()
    {
        return view('pages.terms');
    }

    public function coins(){
        $api = new API(config('azarex.binance_api_key'),config('azarex.binance_secret_key'));
        return dd($api->prices());
    }

}
