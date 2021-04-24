<?php

namespace App\Http\Controllers;

use App\Facades\Rest\Rest;
use App\Http\Controllers\Account\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function redirect()
    {
        try {
            return Socialite::driver('google')->redirect();
        } catch (\Exception $e) {
            return Rest::error($e);
        }
    }

    public function callback()
    {
        try {
            $oAuth = Socialite::driver('google')->user();
            $account = User::whereEmail($oAuth->email)->first();
            if (!$account) {
                $user = new User();
                $user->name = $oAuth->name;
                $user->email = $oAuth->email;
                $user->email_verified_at = Carbon::now();
                $user->save();
            }
//            return Redirect::to(config('hirbod.wc_url'));
            // TODO correct url
//            return Redirect::to('https://hirbod.liara.run');
            return $account;
        } catch (\Exception $e) {
            return Rest::error($e);
        }
    }

    public function verify(Request $request)
    {
        try {
            if (!$request->has('token')) {
                return Rest::badRequest('Bad Request', null);
            }
            $client = new \Google_Client(['client_id' => env('GOOGLE_CLIENT_ID')]);  // Specify the CLIENT_ID of the app that accesses the backend
            $payload = $client->verifyIdToken($request->input('token'));
            if (!$payload) {
                return Rest::badRequest('Bad Request', null);
            }
            $oAuth = collect($payload);
//            $oAuth = Socialite::driver('google')->userFromToken($request->input("token"));
            $user = User::whereEmail($oAuth['email'])->first();
            if (!$user) {
                $user = new User();
                $user->insert([
                    'uuid' => Str::uuid(),
                    'name' => $oAuth['name'],
                    'email' => $oAuth['email'],
                    'password' => null,
                    'username' => Str::random(6),
                    'code_expire' => null
                ]);
                $user = User::whereEmail($oAuth['email'])->first();
            }
            $data = [
                'uuid' => $user->uuid,
                'token' => $user->createToken('Hirbod Access Token')->accessToken,
                'mobile' => $user->country.$user->mobile,
                'name' => $user->name,
                'email' => $user->email,
                'avatar' => null,
                'username' => $user->username,
            ];
            $msg='User Verify.';

            return Rest::success($msg,$data);
        } catch (\Exception $e) {
            return Rest::error($e);
        }
    }

//    public function verify(Request $request)
//    {
//        try {
//            if(!$request->has('token")){
//                return Rest::badRequest('Bad Request', null);
//            }
//            $oAuth = Socialite::driver('google')->userFromToken($request->input("token"));
//            $user = User::whereEmail($oAuth->email)->first();`
//            if (!$user) {
//                $user = new User();
//                $user->name = $oAuth->name;
//                $user->email = $oAuth->email;
//                $user->email_verified_at = Carbon::now();
//                $user->save();
//            }
//            return [
//                'uuid' => $user->uuid,
//                'token' => $user->createToken('Hirbod Access Token')->accessToken,
//                'mobile' => $user->country.$user->mobile,
//                'name' => $user->name,
//                'email' => $user->email,
//                'avatar' => null,
//                'username' => $user->username,
//            ];
//        } catch (\Exception $e) {
//            return Rest::error($e);
//        }
//    }
}
