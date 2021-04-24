<?php


namespace App\Http\Controllers\Milad;


use App\HModels\User;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Podcast\Podcast;

class DashboardController extends Controller
{

    public function index(){
        try{
            $users = User::all()->count();
            $courses = 1212;
            $podcasts = Podcast::all()->count();
            return view('milad.dashboard', compact(
                'users',
                'courses',
                'podcasts'
            ));
        }catch (\Exception $e){
            return dd($e->getMessage());
        }
    }

}
