<?php


namespace App\Http\Controllers\Account;


use App\Enums\SMS\Template;
use App\Enums\SMS\Type;
use App\Facades\Persian\Persian;
use App\Facades\Rest\Rest;
use App\Helpers\FinanceHelper;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Finance\Transaction;
use App\Http\Requests\Auth\OTPRequest;
use App\Http\Requests\Auth\SignRequest;
use App\Http\Requests\Auth\VerifyRequest;
use App\Jobs\SendSMS;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class AuthController extends Controller
{


    /**
     * @param SignRequest $request
     * @return JsonResponse
     */
    public function sign(Request $request)
    {
        try {
            $msg='User Signed';
            $data = [];
            $mobile = checkZeroFirst(trim($request->input('mobile')));
            $country=trim($request->input('country'));
            $captain=null;
            if ($request->has("captain")){
                $captain = User::where(["username"=>$request->input("captain")])->first();
                $captain=$captain->id;
            }
            $code = random_int(1000, 9999);
//            $code = substr($mobile, 6, 4);
            $existingUser = User::where('mobile', $mobile)->first();
            if ($existingUser === null){
                User::create([
                    'mobile' => $mobile,
                    'country' => $country,
                    'code' => $code,
                    'name' => $request->input('name'),
                    'captain' => $captain,
                    "username" => Str::random(6),
                    'code_expire'=>now()->addMinutes(2)
                ]);
                $data['name'] = $request->input('name');
            }else{
                $data['name'] = $existingUser['name'];
                User::where([['mobile','=', $mobile],['country','=',$country]])->update(['code' => $code, 'code_expire'=>now()->addMinutes(2)]);
            }
            if ($request->has('captain')) {
                User::where('username', $captain)->increment('team');
            } else {
                SendSMS::dispatch(Type::AUTH, '0'.$mobile, $code, Template::AUTH);
            }
            return Rest::success($msg,$data);
        } catch (\Exception $exception) {
            return Rest::error($exception);
        }
    }

    /**
     * @param VerifyRequest $request
     * @return JsonResponse
     */
    public function verify(Request $request)
    {
        try {
            $msg='User Verify.';
            $mobile = checkZeroFirst(trim($request->input('mobile')));
            $country =trim($request->input('country'));
            $code = $request->input('code');
            $user = User::where([
                'mobile' => $mobile,
                'country' => $country,
                'code' => $code,
            ])->where('code_expire','>=',now())->first();
            if ($user === null) {
               return Rest::badRequest();
            }
            $data = [
                'uuid' => $user->uuid,
                'token' => $user->createToken('Hirbod Access Token')->accessToken,
                'mobile' => $user->country.$user->mobile,
                'name' => $user->name,
                'email' => $user->email,
                'avatar' => null,
//                "avatar"=> $user->avatar === null ? null :  Storage::temporaryUrl(
//                    'avatars/'.$user->uuid.'/'.$user->avatar,
//                    now()->addMinutes( config('hirbod.temporary.account.owner'))
//                ),
                'username' => $user->username,
            ];
           return Rest::success($msg,$data);
        } catch (\Exception $exception) {
            return Rest::error($exception);
        }
    }

    /**
     * @param OTPRequest $request
     * @return JsonResponse
     */
    public function otp(OTPRequest $request)
    {
        try {
            $msg='OTP Submitted.';
            $mobile = checkZeroFirst($request->input('mobile'));
            $country =trim($request->input('country'));
            $type = ($request->has("type")) ?  $request->input('type') : 'sms';
            $user = User::where([['mobile','=',$mobile],['country','=',$country]])->firstOrFail();
            $code = random_int(1000, 9999);
            $code = substr($mobile, 6, 4);
            $user->update(['code'=>$code,'code_expire'=>now()->addMinutes(2)]);
            SendSMS::dispatch(Type::AUTH, $user->mobile, $user->code, Template::AUTH, $type);
            return Rest::success($msg,null);
        } catch (\Exception $exception) {
            return Rest::error($exception);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function device(Request $request)
    {
        try {
            $msg = 'Device Registered';
            $device = new Device();
            $device->user = auth()->id();
            $device->register_type = $request->register_type;
            $device->ip = $request->ip();
            $device->data_connection = $request->input('data_connection');
            $device->operator_name = $request->input('operator_name');
            $device->sim_operator = $request->input('sim_operator');
            $device->imei = $request->input('imei');
            $device->android_id = $request->input('android_id');
            $device->http_agent = $request->input('http_agent');
            $device->brand = $request->input('brand');
            $device->device = $request->input('device');
            $device->manufacturer = $request->input('manufacturer');
            $device->model = $request->input('model');
            $device->product = $request->input('product');
            $device->type = $request->input('type');
            $device->locale = $request->input('locale');
            $device->package_name = $request->input('package_name');
            $device->package_version_code = $request->input('package_version_code');
            $device->android_sdk = $request->input('android_sdk');
            if ($device->save()) {
                foreach ($request->input('packages', []) as $item) {
                    $package = new Package();
                    $package->device = $device->id;
                    $package->package = $item['package'];
                    $package->first_install = $item['first_install'];
                    $package->version_code = $item['version_code'];
                    $package->version_name = $item['version_name'];
                    $package->save();
                }
            }
            return Rest::success($msg, null);
        }catch (\Exception $exception) {
            return Rest::error($exception);
        }
    }

    /**
     * @param $username
     * @return JsonResponse
     */
    public function captain($username)
    {
        try {
            $msg='Captain Fetched.';
            $data=null;
            $user = User::where('username', $username)->first();
            if ($user === null){
                return Rest::notFound();
            }
            $data = [
                'name' => $user['name'],
                'username' => $user['username'],
                'photo' => $user->avatar === null ? null : Rest::$SARA . $user['avatar'],
                'joined' => $user->jCreated,
                'last_connection' => Persian::datetime($user['last_connection'])
            ];
            return Rest::success($msg,$data);
        } catch (\Exception $e) {
            return Rest::error($e);
        }
    }

    /**
     * @return JsonResponse
     */
    public function revoke()
    {
        try {
            $msg='All access tokens revoked.';
            $user = auth('api')->user()->tokens;
            foreach ($user as $item) {
                $item->revoke();
            }
            return Rest::success($msg,null);
        } catch (\Exception $exception) {
           return Rest::error($exception);
        }
    }


    public  function token(Request $request){
        try{
            $msg='Transaction Fetched.';
            $token=$request->input('token');
            $transaction = Transaction::where(['authority'=> $token,'user'=>auth('api')->user()->id])->firstOrFail();
            $user = User::where('id', $transaction->user)->firstOrFail();
            $data = [
                'token' => $token,
                'amount' => FinanceHelper::rlsToTmn($transaction->amount),
                'mobile' => $user->country.$user->mobile,
                'description' => $transaction->description,
                'cardNumber' => $transaction->cardNumber,
                'transactional_type' => $transaction->transactional_type,
                'transactional_id' => $transaction->transactional_id,
                'traceNumber' => $transaction->trace_number,
                'status' => $transaction->status
            ];
            return Rest::success($msg,$data);
        }catch (\Exception $e){
           return Rest::error($e);
        }
    }

    public  function emailCallback($email){

        try {
            $user=User::whereEmail(Crypt::decrypt($email))->firstOrFail();
            $user->update(['status'=>1]);
            return view('verify.index',compact('user'));
        }catch (\Exception $exception){
            Rest::error($exception);
        }
    }
}