<?php


namespace App\Http\Controllers;


use App\Models\Activity;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;

class ActivityController extends Controller
{

    public function index(){
        try{
            $activities = Activity::me()->latest()->paginate(15);
            return view('activity', compact('activities'));
        }catch (\Exception $e){
            Bugsnag::notifyException($e);
            return back();
        }
    }

}
