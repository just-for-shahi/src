<?php


namespace App\Http\Controllers;


use App\Enums\User\UserRole;
use App\Facades\Rest\Rest;

class AdminController extends Controller
{

    public function devices(){
        try{
            $role = auth('api')->user()->role;
            if ($role != UserRole::Admin || $role != UserRole::SuperAdmin){
                return Rest::badRequest();
            }
            $devices = [
                'MILAD',
                'MILAD-A51',
                'MILAD-J7',
                'MILAD-iPhone X',
                'MILAD-Y330',
                'Mehnoush',
                'Mahsa',
                'Arezoo',
                'Pargol',
                'Shabani'
            ];
            return Rest::success('Admin Devices', $devices);
        }catch (\Exception $e){
            return Rest::error($e);
        }
    }

}