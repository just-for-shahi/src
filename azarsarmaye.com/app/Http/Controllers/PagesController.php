<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        return view('index');
    }

    public function about(){
        return view('errors.404');
    }

    public function contact(){
        return view('errors.404');
    }

}
