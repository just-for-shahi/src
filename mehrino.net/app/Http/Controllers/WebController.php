<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Services\Post\Models\Post;

class WebController extends Controller
{
    public function index()
    {
        $weblogs = Post::latest()->take(3)->with(['categories'])->get();
        return view('index' , compact('weblogs'));
    }

    public function dashboard()
    {
        return view('dashboard');
    }
}
