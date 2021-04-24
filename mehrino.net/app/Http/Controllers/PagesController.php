<?php


namespace App\Http\Controllers;


use App\Enums\ResponseCode;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;

class PagesController extends Controller
{

    public function index(){
        try{
            return view('index');
        }catch (\Exception $e){
            Bugsnag::notify($e);
            return abort(500);
        }
    }

    public function about(){
        try{
            return view('about');
        }catch (\Exception $e){
            Bugsnag::notify($e);
            return abort(ResponseCode::NotFound);
        }
    }

    public function contact(){
        try{
            return view('contact');
        }catch (\Exception $e){
            Bugsnag::notify($e);
            return abort(ResponseCode::NotFound);
        }
    }

    public function donate(){
        try{
            return view('donate');
        }catch (\Exception $e){
            return dd($e);
            Bugsnag::notifyException($e);
            return abort(500);
        }
    }
}
