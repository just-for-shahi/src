<?php


namespace App\Http\Controllers;


class FrontController extends Controller
{

    public function index(){
        return view('index');
    }
    
    public function about(){
        $data['pagename'] = 'about';
        return view('pages.about',compact('data'));        
    }
    
    public function contact(){
        $data['pagename'] = 'contact';
        return view('pages.contact',compact('data'));        
    }
    
    public function faq(){
        $data['pagename'] = 'faqs';
        return view('pages.faq',compact('data'));        
    }
    
    public function privacy(){
        $data['pagename'] = 'privacy';
        return view('pages.privacy',compact('data'));        
    }
    
    public function terms(){
        $data['pagename'] = 'terms';
        return view('pages.terms',compact('data'));        
    }

}
