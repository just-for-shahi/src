<?php


namespace App\Http\Controllers\Account;


use App\Http\Controllers\Controller;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Laravel\Socialite\Facades\Socialite;

class oAuthController extends Controller
{

    public function redirect(){
        try{
            return Socialite::driver('google')->redirect();
        }catch (\Exception $e){
            Bugsnag::notifyException($e);
            return abort(500);
        }
    }

    public function callback(){
        try{
            $oAuth = Socialite::driver('google')->user();
            $account = User::where('email', $oAuth->email)->first();
            if(!$account){
                $user = new User();
                $user->name = $oAuth->name;
                $user->email = $oAuth->email;
                $user->email_verified_at = Carbon::now();
                $user->save();
//                auth()->loginUsingId($user->id);
            }
//            else {
//                auth()->loginUsingId($account->id);
//            }
            return Redirect::to('https://hirbod.ac');
        }catch (\Exception $e){
            return abort(500);
        }
    }
}