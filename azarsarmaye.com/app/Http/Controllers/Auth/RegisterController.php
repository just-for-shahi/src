<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\AccountHelper;
use App\Helpers\ActivityHelper;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'mobile' => ['required', 'max:11', 'regex:/(09)[0-9]{9}/', 'unique:users,mobile'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
        ],[
            'name.required' => 'لطفا نام خود را بنویسید',
            'name.string' => 'لطفا از کاراکترهای مجاز استفاده کنید',
            'name.max' => 'حداکثر تعداد کاراکتر نام 255 کاراکتر است',
            'email.required' => 'لطفا ایمیل خود را بنویسید',
            'email.string' => 'لطفا از کارکترهای مجاز استفاده کنید',
            'email.email' => 'ایمیل شما معتبر نیست',
            'email.max' => 'حداکثر تعداد کاراکتر ایمیل 255 کاراکتر است',
            'email.unique' => 'ایمیل وارد شده قبلا ثبت‌نام کرده است.',
            'mobile.required' => 'لطفا شماره موبایل خود را بنویسید',
            'mobile.max' => 'حداکثر ارقام شماره موبایل 11 رقم است.',
            'mobile.regex' => 'شماره موبایل وارد شده معتبر نیست',
            'mobile.unique' => 'شماره موبایل واردشده قبلا ثبت‌نام شده است.',
            'password.required' => 'رمزعبور خود را بنویسید',
            'password.string' => 'لطفا از کاراکترهای مجاز استفاده کنید',
            'password.min' => 'رمزعبور حداقل باید 4 حرف باشد.',
            'password.confirmed' => 'تکرار رمز عبور، با رمزعبور همخوانی ندارد',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $captain = null;
        $username = Str::random(6);
        if (isset($data['c'])){
            $captain = User::where('username', $data['c'])->first();
            $captain = $captain->id;
            ActivityHelper::store($captain, 'کاربر '.$username.' به تیم شما اضافه شد. 10% از اولین سرمایه‌گذاری به عنوان کاپیتان پرداخت خواهد شد.');
        }
        $usr = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'mobile' => $data['mobile'],
            'password' => Hash::make($data['password']),
            'username' => $username,
            'captain' => $captain
        ]);
        $account = Account::create([
            'no' => AccountHelper::no(),
            'user_id' => $usr->id,
            'type' => 0,
            'plan' => 0,
            'balance' => 0,
            'status' => 0
        ]);
        ActivityHelper::store($usr->id, 'به خانواده یوانوست خوش آمدید.');
        ActivityHelper::store($usr->id, 'اولین حساب مالی شما ایجاد شد. شماره حساب مالی: '.$account->no);
        return $usr;
    }
}
