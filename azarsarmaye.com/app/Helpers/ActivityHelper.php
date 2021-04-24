<?php


namespace App\Helpers;


use App\Models\Activity;

class ActivityHelper
{


    public static function store($user, $description){
        Activity::create([
            'user_id' => $user,
            'description' => $description
        ]);
    }
}
