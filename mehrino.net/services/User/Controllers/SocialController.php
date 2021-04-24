<?php


namespace Services\User\Controllers;


use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Services\User\Repositories\IAutoMapperRepository;
use Services\User\Repositories\IUserRepository;

class SocialController
{
    public function __construct(IUserRepository $account, IAutoMapperRepository $mapper)
    {
        $this->account = $account;
        $this->mapper = $mapper;
    }

    public function redirect()
    {
        try {
            return Socialite::driver('google')->redirect();
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }

    public function callback()
    {
        try {
            $oAuth = Socialite::driver('google')->user();
            $account = $this->account->findEmail($oAuth->email);
            if (!$account) {
                $account = $this->account->insert([
                    'name' => $oAuth->name,
                    'email' => $oAuth->email,
                    'password' => null,
                    "username" => Str::random(6),
                    'code_expire' => null
                ]);
            }
            return [$oAuth, $account];
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }

    public function verify(Request $request)
    {
        try {
            if (!$request->has("token")) {
                return BadRequest400();
            }
            $client = new \Google_Client(['client_id' => env('GOOGLE_CLIENT_ID')]);  // Specify the CLIENT_ID of the app that accesses the backend
            $payload = $client->verifyIdToken($request->input("token"));
            if (!$payload) {
                return BadRequest400();
            }
            $oAuth = collect($payload);
//            $oAuth = Socialite::driver('google')->userFromToken($request->input("token"));
            $account = $this->account->findEmail($oAuth['email']);
            if (!$account) {
                $account = $this->account->insert([
                    'name' => $oAuth['name'],
                    'email' => $oAuth['email'],
                    'password' => null,
                    "username" => Str::random(6),
                    'code_expire' => null
                ]);
            }
            return OK($this->mapper->verify($account));
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }

}
