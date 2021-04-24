<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class FrontArbicController extends Controller {

    public function index(){
        $data['pagename'] = 'Home';
        return view('pages.ar.index',compact('data'));
    }
    
    public function about(){
        $data['pagename'] = 'about';
        return view('pages.ar.about',compact('data'));        
    }
    
    public function contact(){
        $data['pagename'] = 'contact';
        return view('pages.ar.contact',compact('data'));        
    }
    
    public function faq(){
        $data['pagename'] = 'faqs';
        return view('pages.ar.faq',compact('data'));        
    }
    
    public function privacy(){
        $data['pagename'] = 'privacy';
        return view('pages.ar.privacy',compact('data'));        
    }
    
    public function terms(){
        $data['pagename'] = 'terms';
        return view('pages.ar.terms',compact('data'));        
    }

}
