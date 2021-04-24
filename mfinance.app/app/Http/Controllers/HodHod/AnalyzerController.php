<?php


namespace App\Http\Controllers\HodHod;


use App\Http\Controllers\Controller;

class AnalyzerController extends Controller
{

    public function index(){
        return redirect()->route('dashboard');
    }

}
