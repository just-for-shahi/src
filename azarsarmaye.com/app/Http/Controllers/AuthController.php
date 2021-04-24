<?php


namespace App\Http\Controllers;


use App\Enums\SMSTemplate;
use App\Enums\SMSType;
use App\Jobs\SendSMS;
use App\Models\Account;
use App\Models\Investment;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{

    public function login(){
        try{
            return \view('auth.login');
        }catch (\Exception $e){
            return \view('error');
        }
    }

    public function register(){
        try{
            return \view('auth.register');
        }catch (\Exception $e){
            return \view('error');
        }
    }


    /**
     * @param Request $request
     * @return Factory|View|RedirectResponse
     */
    public function registered(Request $request)
    {
        try {
            $email = $request->input('email');
            $password = Hash::make($request->input('password'));
            $captain=null;
            if ($request->has("captain")){
                $captain = User::where(["username"=>$request->input("captain")])->first();
                if ($captain != null){
                    $captain=$captain['id'];
                }
            }
            $usr = User::create([
                'email' => $email,
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'captain' => $captain,
                "username" => Str::random(6),
                'code_expire'=>now()->addMinutes(2),
                'password' => $password
            ]);
            $acc = Account::create([
                'user_id' => $usr['id'],
                'uuid' => \Illuminate\Support\Str::uuid(),
                'no' => \App\Helpers\AccountHelper::no(),
                'name' => 'پیشفرض',
                'color' => 0,
                'balance' => 0,
                'growth' => 0,
                'harvestable' => 0,
                'status' => 0
            ]);
            if ($request->has('amount')){
                $transaction = Transaction::create([
                    'user_id' => $usr['id'],
                    'from' => 0,
                    'to' => $acc['id'],
                    'amount' => $request->input('amount'),
                    'description' => 'سرمایه گذاری اولیه',
                    'authority' => intval('00' . random_int(10000, 99999)),
                    'status' => 0,
                    'gateway' => 0,
                ]);
                Investment::create([
                    'user_id' => $usr['id'],
                    'account' => $acc['id'],
                    'transaction' => $transaction['id'],
                    'amount' => $request->input('amount'),
                ]);
            }
            if ($request->has('captain')) {
                User::where('username', $captain)->increment('team');
            }
            Auth::loginUsingId($usr['id']);
            return redirect()->route('dashboard');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'credentials']);
        }
    }

    /**
     * @param Request $request
     */
    public function verify(Request $request)
    {
        try {
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                return redirect()->route('dashboard');
            }else{
                return back()->withInput()->withErrors(['error' => 'credentials']);
            }
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'credentials']);
        }
    }

    /**
     * @return void|RedirectResponse
     */
    public function logout()
    {
        try {
            auth()->logout();
            return redirect()->route('index');
        } catch (\Exception $e) {
            return abort(500);
        }
    }

    public function redirect(){
        try{
            return Socialite::driver('google')->redirect();
        }catch (\Exception $e){
            return dd($e);
        }
    }

    public function callback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $usr = User::where('email', $user->getEmail())->first();
            if ($usr === null) {
                $usr = User::create([
                    'first_name' => $user->getName(),
                    'email' => $user->getEmail()
                ]);
            }
            auth()->loginUsingId($usr['id']);
            return redirect()->route('dashboard');
        } catch (\Exception $e) {
            return abort(500);
        }
    }

}
