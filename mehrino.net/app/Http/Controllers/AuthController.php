<?php


namespace App\Http\Controllers;


use App\Enums\SMSTemplate;
use App\Enums\SMSType;
use App\Facades\Persian\Persian;
use App\Jobs\SendSMS;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
    public function verify(Request $request)
    {
        try {
            $mobile = $request->input('mobile');
            $captain=null;
            if ($request->has("captain")){
                $captain = User::where(["username"=>$request->input("captain")])->first();
                if ($captain != null){
                    $captain=$captain['id'];
                }
            }
            $code = random_int(1000, 999999);
            $code = '1916';
            $existingUser = User::where('mobile', $mobile)->first();
            if ($existingUser === null){
                User::create([
                    'mobile' => $mobile,
                    'code' => $code,
                    'name' => $request->input('name'),
                    'captain' => $captain,
                    "username" => Str::random(6),
                    'code_expire'=>now()->addMinutes(2)
                ]);
            }else{
                User::where('mobile', $mobile)->update(['code' => $code, 'code_expire'=>now()->addMinutes(2)]);
            }
            if ($request->has('captain')) {
                User::where('username', $captain)->increment('team');
            }
            SendSMS::dispatch(SMSType::AUTH, $mobile, $code, SMSTemplate::VERIFY);
            return view('auth.verify', compact('mobile'));
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'credentials']);
        }
    }

    /**
     * @param Request $request
     */
    public function verified(Request $request)
    {
        try {
            $mobile = $request->input('mobile');
            $code = $request->input('code');
            $user = User::where([
                'mobile' => $mobile,
                'code' => $code,
            ])->where('code_expire','>=',now())->first();
            if ($user === null) {
                return dd($user);
                return back()->withInput()->withErrors(['error' => 'credentials']);
            }
            auth()->loginUsingId($user['id'], false);
            return redirect()->route('dashboard');
        } catch (\Exception $e) {
            return dd($e);
            return back()->withInput()->withErrors(['error' => 'credentials']);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function otp(Request $request)
    {
        try {
            $mobile = self::checkZeroFirst($request->input('mobile'));
            $type = ($request->has("type")) ?  $request->input('type') : 'sms';
            $user = User::where('mobile', $mobile)->firstOrFail();
            $code = random_int(1000, 9999);
            $user->update(['code'=>$code,'code_expire'=>now()->addMinutes(2)]);
            SendSMS::dispatch(SMSType::AUTH, $user->mobile, $user->code, SMSTemplate::VERIFY, $type);
            return Rest::success(null);
        } catch (\Exception $e) {
            return Rest::error($e);
        }
    }

    function checkZeroFirst($string){
        if($string[0]==='0')
        {
            return substr($string,1);
        }
        return $string;
    }

    /**
     * @param $username
     * @return JsonResponse
     */
    public function captain($username)
    {
        try {
            $data=null;
            $user = User::where('username', $username)->first();
            if ($user === null){
                return Rest::notFound();
            }
            $res = [
                'name' => $user['name'],
                'username' => $user['username'],
                'photo' => $user->avatar === null ? null : Rest::$SARA . $user['avatar'],
                'joined' => $user->jCreated,
                'last_connection' => Persian::datetime($user['last_connection'])
            ];
            return Rest::success($res);
        } catch (\Exception $e) {
            return Rest::error($e);
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
