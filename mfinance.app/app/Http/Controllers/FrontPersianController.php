<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class FrontPersianController extends Controller {

    public function index(){
        $data['pagename'] = 'Home';
        return view('pages.pe.index',compact('data'));
    }
    
    public function about(){
        $data['pagename'] = 'about';
        return view('pages.pe.about',compact('data'));        
    }
    
    public function contact(){
        $data['pagename'] = 'contact';
        return view('pages.pe.contact',compact('data'));        
    }
    
    public function faq(){
        $data['pagename'] = 'faqs';
        return view('pages.pe.faq',compact('data'));        
    }
    
    public function privacy(){
        $data['pagename'] = 'privacy';
        return view('pages.pe.privacy',compact('data'));        
    }
    
    public function terms(){
        $data['pagename'] = 'terms';
        return view('pages.pe.terms',compact('data'));        
    }

}
