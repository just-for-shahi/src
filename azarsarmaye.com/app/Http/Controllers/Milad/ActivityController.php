<?php


namespace App\Http\Controllers\Milad;


use App\Http\Controllers\Controller;
use App\Models\Activity;

class ActivityController extends Controller
{

    private $entity;

    public function __construct()
    {
        $this->entity = new Activity();
    }

    public function index(){
        return view('activity', ['activities' => Activity::latest()->paginate(15)]);
    }

}
