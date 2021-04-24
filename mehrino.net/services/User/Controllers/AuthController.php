<?php


namespace Services\User\Controllers;


use App\Http\Controllers\Controller;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Services\User\Repositories\IAutoMapperRepository;
use Services\User\Repositories\IEmailRepository;
use Services\User\Requests\AuthOtpRequests;
use Services\User\Requests\AuthSignRequests;
use Services\User\Requests\AuthVerifyRequests;
use Services\User\Repositories\IUserRepository;
use Services\User\Repositories\ISmsRepository;


class AuthController extends Controller
{
    protected $account;
    protected $sms;
    protected $email;
    protected $mapper;

    public function __construct(IUserRepository $account,
                                ISmsRepository $sms,
                                IEmailRepository $email,
                                IAutoMapperRepository $mapper
    )
    {
        $this->account = $account;
        $this->sms = $sms;
        $this->email = $email;
        $this->mapper = $mapper;
    }


    public function sign(AuthSignRequests $request)
    {
        try {
            $type = $request->input('type');
            $value = $request->input('value');
            $captain = $request->input('captain');
            if ($type === 'mobile') {
                if (!preg_match('/^[0-9]{1,4}[0-9]{10}$/u', $value)) {
                    return BadRequest400();
                }
                // @TODO: Sign up code is last 4 digits from mobile number
                [$prefix, $mobile] = $this->account->splitMobile($value);
                $otp = $this->sms->otp();
                $existingUser = $this->account->findMobile($mobile);
                if ($existingUser === null) {
                    $this->account->insert($this->mapper->sign($otp, $captain, $prefix, $mobile, $request->input('name')));
                    if ($request->has('captain')) {
                        $this->account->query()->where('username', $captain)->increment('team');
                    }
                } else {
                    $existingUser->update(['code' => $otp, 'code_expire' => now()->addMinutes(3)]);
                }
                $this->sms->commit($value);

            } else {
                if (!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/u', $value)) {
                    return BadRequest400();
                }
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
            }
            return OK();
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }

    }

    public function signup(AuthSignRequests $request)
    {
        try {
            $type = $request->input('type');
            $value = $request->input('value');
            $password = $request->input('password');
            if ($type === 'mobile') {
                if (!preg_match('/^[0-9]{1,4}[0-9]{10}$/u', $value)) {
                    return BadRequest400();
                }
                // @TODO: Sign up code is last 4 digits from mobile number
                [$prefix, $mobile] = $this->account->splitMobile($value);
                $otp = $this->sms->otp((int)substr($mobile, strlen($mobile) - 4, 4));
                $existingUser = $this->account->findMobile($mobile);
                if ($existingUser === null) {
                    $this->account->insert($this->mapper->signUp($otp, $password, $prefix, $mobile, $request->input('name')));
                    // SMS sending
                    $this->sms->commit($value);
                } else {
                    return Forbidden403();
                }

            } else {
                if (!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/u', $value)) {
                    return BadRequest400();
                }
                $existingUser = $this->account->findEmail($value);
                // @TODO: Sign up code is last 4 digits from mobile number
                $otp = $this->email->otp(1001);
                if ($existingUser === null) {
                    $this->account->insert($this->mapper->signUp($otp, $password, null, null, $request->input('name'), $value));
                    // email sending
                    $this->email->commit($value);
                } else {
                    return Forbidden403();
                }
            }
            return OK();
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }

    }

    public function signin(AuthSignRequests $request)
    {
        try {
            $addMinutes = 300;
            $type = $request->input('type');
            $value = $request->input('value');
            $password = $request->input('password');
            if ($type === 'mobile') {
                if (!preg_match('/^[0-9]{1,4}[0-9]{10}$/u', $value)) {
                    return BadRequest400();
                }
                [$prefix, $mobile] = $this->account->splitMobile($value);
                $existingUser = $this->account->findMobile($mobile);
                if ($existingUser === null) {
                    return Forbidden403();
                }

            } else {
                if (!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/u', $value)) {
                    return BadRequest400();
                }
                $existingUser = $this->account->findEmail($value);
                if ($existingUser === null) {
                    return Forbidden403();
                }
            }
            if (Hash::check($password, $existingUser->getAuthPassword())) {
                return OK($this->mapper->verify($existingUser));
            }
            return Forbidden403();
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }

    }


    public function verify(AuthVerifyRequests $request)
    {
        try {
            $type = $request->input('type');
            $value = $request->input('value');
            $otp = $request->input('otp');
            if ($type === 'mobile') {
                if (!preg_match('/^[0-9]{1,4}[0-9]{10}$/u', $value)) {
                    return Forbidden403();
                }
                [$prefix, $mobile] = $this->account->splitMobile($value);
                $existingUser = $this->account->findMobile($mobile);
            } elseif ($type === 'email') {
                if (!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/u', $value)) {
                    return Forbidden403();
                }
                $existingUser = $this->account->findEmail($value);
            } else {
                return Forbidden403();
            }
            if ($existingUser === null) {
                notify("Forbidden403");
                return Forbidden403();
            }
            if ($existingUser->code != $otp) {
                notify("BadRequest400");
                return BadRequest400();
            }
            if ($existingUser->code_expire <= now()) {
                notify("NotAcceptable406");
                return NotAcceptable406();
            }
            return OK($this->mapper->verify($existingUser));
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }


    public function otp(AuthOtpRequests $request)
    {
        try {
            $type = $request->input('type');
            $value = $request->input('value');
            $type_otp = $request->input('type_otp', 'sms');
            if ($type === 'mobile') {
                [$prefix, $mobile] = $this->account->splitMobile($value);
                $user = $this->account->findMobile($mobile);
                if (!$user) {
                    return Forbidden403();
                }
                $otp = $this->sms->otp();
                $this->sms->setTypeOtp($type_otp);
                $this->sms->commit($value);
            } elseif ($type === 'email') {
                $user = $this->account->findEmail($value);
                if (!$user) {
                    return Forbidden403();
                }
                $otp = $this->email->otp();
                $this->email->commit($value);
            } else {
                return BadRequest400();
            }

            $user->update(['code' => $otp, 'code_expire' => now()->addMinutes(config('mehrino.auth.expire'))]);
            return Ok();
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }


    public function revoke()
    {
        try {
            $user = \auth()->user()->tokens;
            foreach ($user as $item) {
                $item->revoke();
            }
            return OK();
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }


    public function captain(string $username)
    {
        try {
            $user = $this->account->findUsername($username);
            if ($user === null) {
                return NotFound404();
            }
            return OK($this->mapper->captain($user));
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }
}
