<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class FrontTurkishController extends Controller {

    public function index(){
        $data['pagename'] = 'Home';
        return view('pages.tu.index',compact('data'));
    }
    
    public function about(){
        $data['pagename'] = 'about';
        return view('pages.tu.about',compact('data'));        
    }
    
    public function contact(){
        $data['pagename'] = 'contact';
        return view('pages.tu.contact',compact('data'));        
    }
    
    public function faq(){
        $data['pagename'] = 'faqs';
        return view('pages.tu.faq',compact('data'));        
    }
    
    public function privacy(){
        $data['pagename'] = 'privacy';
        return view('pages.tu.privacy',compact('data'));        
    }
    
    public function terms(){
        $data['pagename'] = 'terms';
        return view('pages.tu.terms',compact('data'));        
    }

}
