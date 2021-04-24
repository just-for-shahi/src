<?php


namespace App\Http\Controllers;


use App\Http\Controllers\Account\Account;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(){
        try{
            return view('auth.login');
        }catch (\Exception $e){
            return abort(404);
        }
    }

    public function verify(Request $r){
        try{
            $credentials = $r->only('email', 'password');
            if (Auth::attempt($credentials)) {
                return redirect()->intended('panel.dashboard');
            }
            return back()->withErrors(['result' => 'failed']);
        }catch (\Exception $e){
            return dd($e->getMessage());
        }
    }

    public function register()
    {
        return view('auth.register');
    }

    public function registered(Request $r)
    {
        $validator = $r->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'first_name' => 'required|string|max:60'
        ]);
        $validator['password'] = Hash::make($r->input('password'));
        $validator['registered_ip'] = $r->ip();
        $validator['username'] = strstr($validator['email'], '@', true);
        $acc = User::create($validator);
        \auth()->login($acc);
        return redirect()->route('panel.dashboard');
    }



}
