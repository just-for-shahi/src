<?php


namespace App\Http\Controllers;


use App\Enums\Account\Role;
use App\Http\Controllers\Account\Account;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

/**
 * Web AuthController
 * Class AuthController
 * @package App\Http\Controllers
 */
class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest')->except(['logout']);
        $this->middleware('auth')->only(['logout']);
    }

    public function show()
    {
        $page_title = 'Login';
        return view('auth.login', compact('page_title'));
    }

    public function login(Request $r)
    {
        $r->validate([
            'email' => nope()->email()->get(1),
            'password' => nope()->string()->get(1)
        ]);

        $credentials = $r->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard');
        }

        return back()->withErrors(['result' => 'failed']);
    }

    public function registerShow()
    {
        $page_title = 'Register';
        return view('auth.register', compact('page_title'));
    }

    public function register(Request $r)
    {
        $validator = $r->validate([
            'email' => 'required|email|unique:accounts,email',
            'password' => 'required|min:6',
            'first_name' => 'required|string|max:60'
        ]);
        $validator['password'] = Hash::make($r->input('password'));
        $acc = Account::create($validator);
        \auth()->login($acc);

        return redirect()->route('dashboard');
    }

    public function redirect()
    {
        try {
            return Socialite::driver('google')->redirect();
        } catch (\Exception $exception) {
            notifyException($exception);
            throw $exception;
        }
    }

    public function callback()
    {
        try {

            $user = Socialite::driver('google')->user();
            $acc = Account::where('email', $user->getEmail())->first();
            if ($acc === null) {
                $acc = Account::create([
                    'first_name' => $user->user['given_name'] ?? $user->getName(),
                    'last_name' => $user->user['family_name'] ?? null,
                    'email' => $user->getEmail(),
                    'role' => Role::NORMAL,
                    'avatar' => $user->getAvatar()
                ]);
            }

            auth()->login($acc);
            return redirect()->route('dashboard');

        } catch (\Exception $exception) {
            notifyException($exception);
            return redirect()->route('register.show')->withErrors(['result' => 'failed']);
        }
    }

    public function logout()
    {
        auth()->logout();
        session()->regenerate(true);

        return redirect()->route('dashboard');
    }

}
