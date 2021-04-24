<?php


namespace Services\User\Controllers;


use App\Enums\SMSTemplate;
use App\Enums\SMSType;
use App\Http\Controllers\Controller;
use App\Jobs\SendSMS;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Services\User\Repositories\IAutoMapperRepository;
use Services\User\Repositories\IEmailRepository;
use Services\User\Repositories\ISmsRepository;
use Services\User\Repositories\IUserRepository;

use function auth;
use function view;

class WebController extends Controller
{
    protected $account;
    protected $sms;
    protected $email;
    protected $mapper;

    public function __construct(
        IUserRepository $account,
        ISmsRepository $sms,
        IEmailRepository $email,
        IAutoMapperRepository $mapper
    ) {
        $this->middleware(['guest:web'])->except('logout');
        $this->middleware(['auth:web'])->only('logout');
        $this->account = $account;
        $this->sms = $sms;
        $this->email = $email;
        $this->mapper = $mapper;
    }

    public function login()
    {
        try {
            return view('views::login');
        } catch (Exception $e) {
            return abort(404);
        }
    }

    /**
     * @param Request $request
     * @return Application|Factory|View|RedirectResponse
     */
    public function verify(Request $request)
    {
        try {
            $value = $request->input('mobile');
            if (preg_match('/^[0-9]{1,4}[0-9]{10}$/u', $value)) {
                $mobile = $this->checkZeroFirst($request->input('mobile'));
                $captain = null;
                if ($request->has("captain")) {
                    $captain = User::where(["username" => $request->input("captain")])->first();
                    if ($captain != null) {
                        $captain = $captain['id'];
                    }
                }

                $code = random_int(1000, 999999);
                $existingUser = User::where('mobile', $mobile)->first();
                if ($existingUser === null) {
                    User::create([
                        'mobile' => $mobile,
                        'code' => $code,
                        'name' => $request->input('name'),
                        'captain' => $captain,
                        "username" => Str::random(6),
                        'code_expire' => now()->addMinutes(2)
                    ]);
                    if ($request->has('captain')) {
                        User::where('username', $captain)->increment('team');
                    }
                } else {
                    User::where('mobile', $mobile)->update(['code' => $code, 'code_expire' => now()->addMinutes(2)]);
                }
                SendSMS::dispatch(SMSType::AUTH, $mobile, $code, SMSTemplate::VERIFY);
                return view('views::verify', compact('mobile'));
            } else if (preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/u', $value)) {
                $captain = $request->input('captain');
                $existingUser = $this->account->findEmail($value);
                // @TODO: Sign up code is last 4 digits from mobile number
                $otp = $this->email->otp();
                if ($existingUser === null) {
                    $this->account->insert($this->mapper->sign($otp, $captain, null, null, $request->input('name'), $value));
                    if ($request->has('captain')) {
                        $this->account->query()->where('username', $captain)->increment('team');
                    }
                } else {
                    $existingUser->update(['code' => $otp, 'code_expire' => now()->addMinutes(3)]);
                }
                $this->email->commit($value);
                return view('views::verify',  ['mobile' => $value]);
            }
            return back()->withInput()->withErrors(['error' => 'credentials']);
        } catch (Exception $e) {
            return back()->withInput()->withErrors(['error' => 'credentials']);
        }
    }

    /**
     * @param Request $request
     */
    public function verified(Request $request)
    {
        try {
            $value = $request->input('mobile');
            if (preg_match('/^[0-9]{1,4}[0-9]{10}$/u', $value)) {
                $mobile = $this->checkZeroFirst($request->input('mobile'));
                $code = $request->input('code');
                $user = User::where([
                    'mobile' => $mobile,
                    'code' => $code,
                ])->where('code_expire', '>=', now())->first();
            } else if (preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/u', $value)) {
                $code = $request->input('code');
                $user = User::where([
                    'email' => $value,
                    'code' => $code,
                ])->where('code_expire', '>=', now())->first();
            }
            if ($user == null) {
                return back()->withInput()->withErrors(['error' => 'credentials']);
            }
            auth()->guard('web')->loginUsingId($user['id'], true);
            return redirect()->route('dashboard');
        } catch (Exception $e) {
            return back()->withInput()->withErrors(['error' => 'credentials']);
        }
    }

    function checkZeroFirst($string)
    {
        if ($string[0] === '0') {
            return substr($string, 1);
        }
        return $string;
    }

    /**
     * @return RedirectResponse|void
     */
    public function logout()
    {
        try {
            auth()->guard('web')->logout();
            return redirect()->route('index');
        } catch (Exception $e) {
            return abort(500);
        }
    }

    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|void
     */
    public function redirect()
    {
        try {
            return Socialite::driver('google')->redirect();
        } catch (Exception $e) {
            return abort(500);
        }
    }

    /**
     * @return RedirectResponse|void
     */
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
            auth()->guard('web')->loginUsingId($usr['id']);
            return redirect()->route('dashboard');
        } catch (Exception $e) {
            return abort(500);
        }
    }
}
