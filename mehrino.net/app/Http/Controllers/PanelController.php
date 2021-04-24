<?php


namespace App\Http\Controllers;


use Bugsnag\BugsnagLaravel\Facades\Bugsnag;

class PanelController extends Controller
{

    public function index(){
        try{
            return view('dashboard');
        }catch (\Exception $e){
            Bugsnag::notifyException($e);
            return abort(500);
        }
    }

}
