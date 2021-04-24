<?php


namespace App\Http\Controllers;


class UserController extends Controller
{

    public function overview(){
        $user = auth()->user();
        return view('profile.overview', compact('user'));
    }

}
