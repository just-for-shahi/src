<?php

namespace App\Http\Controllers;

use App\Http\Controllers\EBook\EBook;
use App\Http\Controllers\Podcast\Podcast;
use App\Http\Controllers\Ticket\Ticket;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        try{
            $ebooksCount = EBook::me()->get()->count();
            $coursesCount = EBook::me()->get()->count();
            $podcastsCount = Podcast::me()->get()->count();
            $courses = [];
            $ebooks = EBook::me()->latest()->take(3)->get();
            $podcasts = Podcast::me()->latest()->take(3)->get();
            $tickets = Ticket::has('me')->latest()->take(3)->get();
            return view('dashboard', compact('ebooksCount','coursesCount', 'podcastsCount', 'courses','ebooks','podcasts','tickets'));
        }catch (\Exception $e){
            return dd($e);
        }
    }
}
