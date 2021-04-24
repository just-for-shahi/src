<?php

namespace App\Http\Controllers\Api;

use Hash;
use Illuminate\Support\Str;
use App\Helpers\MT4Commands;
use App\User;
use App\Models\Copier;
use App\Models\Account;
use App\Mail\SignalEmail;
use App\Models\ApiServer;
use App\Mail\OrderNewEmail;
use Illuminate\Http\Request;
use App\Models\AccountStatus;
use App\Mail\OrderSignalEmail;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\UserEmailSubscription;
use Illuminate\Support\Facades\Validator;
use Encore\Admin\Auth\Database\Administrator;
use Tymon\JWTAuth\Claims\Subject;
use Wpb\StringBladeCompiler\Facades\StringView;

class UserController extends Controller
{

    public function create(Request $request)
    {
        $credentials = $request->only('username', 'name', 'email', 'password');
        $rules = [
            'username' => 'required|max:255|unique:admin_users',
            'email' => 'required|email|max:255|unique:admin_users',
            'password' => 'required|min:6',
        ];
        $validator = Validator::make($credentials, $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->messages()]);
        }
        $username = $request->username;
        $name = $request->username;
        $email = $request->email;
        $password = $request->password;
        $api_token = Str::random(12);

        User::create(['username' => $username, 'name' => $name, 'email' => $email, 'password' => Hash::make($password), 'api_token' => $api_token]);

        return response()->json(['success' => true, 'api_token' => $api_token]);
    }

    public function mydetails(Request $request)
    {
        $data = $this->_getDetails('id', $request->user()->id);

        if ($data == false) {
            return response()->json(['success' => false, 'message' => 'user not found']);
        }

        return response()->json(['success' => true, 'data' => $data]);
    }

    public function detailsByEmail(Request $request, $email)
    {
        $data = $this->_getDetails('email', $request['email']);

        if ($data == false) {
            return response()->json(['success' => false, 'message' => 'user not found']);
        }

        return response()->json(['success' => true, 'data' => $data]);
    }

    public function details(Request $request, $id)
    {
        $data = $this->_getDetails('id', $id);

        if ($data == false) {
            return response()->json(['success' => false, 'message' => 'user not found']);
        }
        return response()->json(['success' => true, 'data' => $data]);
    }

    private function _getDetails($key, $keyValue)
    {
        $user = Administrator::where($key, $keyValue)->first();

        if(!$user)
            return false;

        $with = array();
        if ($user->can('usr.copier_subscriptions')) {
            $with[] = 'copiersubscriptions';
            $with[] = 'accounts';
        }

        if ($user->can('usr.email_subscriptions')) {
            $with[] = 'emailsubscriptions';
        }

        if ($user->can('usr.expert_subscriptions')) {
            $with[] = 'expertsubscriptions';
            $with[] = 'accounts';
            $with[] = 'experts';
        }

        //DB::enableQueryLog();
        $user = User::with(array_unique($with))
        ->where($key, $keyValue)
        ->get();

        //var_dump( DB::getQueryLog());
        if ($user == false) {
            return false;
        }

        return $user;
    }

    public function remove(Request $request, $id)
    {
        $user = User::find($id);

        if ($user != false) {
            $user->delete();
            return response()->json(['success' => true, 'message' => 'User removed']);
        }

        return response()->json(['success' => false, 'message' => 'User not found']);
    }

    public function removeByEmail(Request $request, $email)
    {
        $user = User::where('email', $email)->first();

        if ($user != false) {
            $user->delete();
            return response()->json(['success' => true, 'message' => 'User removed']);
        }

        return response()->json(['success' => false, 'message' => 'User not found']);
    }

    public function debug(Request $request)
    {

        echo MT4Commands::wsSendOrderCloseSignal(11527520, [167293453]);
        // $data['channel'] = 'system';
        // $data['command'] = 'get_online';
        // $ws_host = config('admin.ws_host');
        // echo MT4Commands::wsSendCommand($ws_host, \json_encode($data));

//         Amp\Loop::run(function () {
// //        $handshake = (new Handshake('ws://demos.kaazing.com/echo'))
//             $handshake = (new Handshake('ws://192.168.88.254:8080'))
//                 ->addHeader('account', '123');

//             $connection = yield connect($handshake);
//             //ddd($connection);
//             yield $connection->send('Hello!');
//         });
        return response()->json(['success' => true, 'message' => 'OK']);
    }

}
