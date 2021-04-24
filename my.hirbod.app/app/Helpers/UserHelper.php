<?php


namespace App\Helpers;


use App\HModels\User;

class UserHelper
{

    public static function summary($id){
        try{
            $usr = User::find($id);
            if ($usr != null){
                return $usr['name'];
            }
        }catch (\Exception $e){
            return null;
        }
    }


}
