<?php


namespace App\Http\Controllers\Account\Setting;


use App\Facades\Rest\Tag;
use App\Http\Controllers\Account\User;
use App\Http\Controllers\Controller;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    private $entity;

    public function __construct()
    {
        $this->entity = new User();
    }



    public function update(Request $request){

        try {

            $msg='Setting Updated.';
            $user=$this->entity->whereId(auth('api')->user()->id)->firstOrFail();

            if (!empty($request->input('notification'))) {
                $user->update(['notification' =>$request->input('notification')]);
            }
            if (!empty($request->input('sms'))) {
                $user->update(['sms' =>$request->input('sms')]);
            }
            if (!empty($request->input('ads'))) {
                $user->update(['ads' =>$request->input('ads')]);
            }
            if (!empty($request->input('kids_mode'))) {
                $user->update(['kids_mode' =>request()->input('kids_mode')]);
            }
            if (!empty($request->input('theme'))) {
                $user->update(['theme' =>$request->input('theme')]);
            }

           $data=[
               "notification"=>$user->notification,
               "sms"=>$user->sms,
               "ads"=>$user->ads,
               "kids_mode"=>$user->kids_mode,
               "theme"=>$user->theme,
           ];
           return Tag::success($msg,$data);
        } catch (\Exception $exception) {
           return Tag::error($exception);
        }
    }

}