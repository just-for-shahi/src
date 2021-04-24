<?php


namespace App\Http\Controllers\Milad;


use App\HModels\User;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    private $model;

    public function __construct()
    {
        $this->model = new User();
    }

    public function index(){
        try{
            $items = User::latest()->paginate(15);
            return view('milad.users', compact('items'));
        }catch (\Exception $e){
            return dd($e->getMessage());
        }
    }

}
