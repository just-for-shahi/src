<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\ApiServer;
use App\Models\AccountStat;
use App\Models\AccountStatus;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redis;

class AccountController extends Controller
{

    public function getOrCreate(Request $request)
    {
        try {
            $info = $request->only('account_number', 'broker_name');

            $rules = [
                'account_number' => 'required|numeric',
                'broker_name' => 'required'
            ];
            $validator = Validator::make($info, $rules);
            if ($validator->fails()) {
                return response()->json(['success' => false, 'message' => $validator->messages()]);
            }

            $account = Account::where( 'account_number', $request['account_number'] )
                ->first(['id', 'user_id','copier_type']);

            if ($account != false) {
                if($account->user_id != $request->user()->id)
                    return response()->json(['success' => false, 'message' => 'Account exists and but does not belong to you']);
                else
                    return response()->json(['success' => true, 'account' => $account]);
            }

            $user = User::with('subscriptionsettings')->withCount('accounts')->find($request->user()->id);

            if(isset($user->subscriptionsettings) && $user->subscriptionsettings->max_accounts <= $user->accounts_count ) {
                return response()->json(['success' => false, 'message' => 'Max accounts is reached']);
            }

            $is_manager = $request['is_manager'];

            $manager_id = $request->user()->manager_id;
            if($is_manager == 1)
                $manager_id = $request->user()->id;

            $account = Account::create(
                ['copier_type' => $request['copier_type'],
                'account_number' => $request['account_number'],
                'broker_server_name' => $request['broker_name'],
                'user_id' => $request->user()->id,
                'creator_id' => $request->user()->id,
                'manager_id' => $manager_id,
                'account_status' => AccountStatus::ONLINE,
                ]);
            return response()->json(['success' => true, 'account' => $account]);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function listAll(Request $request)
    {
        return response()->json(
            Account::with('stat')->where('user_id', $request->user()->id)->get()
        );
    }

    public function get(Request $request, $id)
    {
        return response()->json(Account::find(
            $id,
            ['id','account_number', 'balance', 'account_status', 'name', 'broker_server_name']
        ));
    }

    public function getRealTime(Request $request, $id)
    {
        $data = Redis::get($id . '_realtime');
        return response($data, 200)
                  ->header('Content-Type', 'application/json');
    }

    public function delete(Request $request, $id)
    {
        $account = Account::where([['id', $id], ['user_id', $request->user()->id]])->first();
        //response()->json($account);
        //return;
        if ($account && $account->delete()) {
            return response()->json(['success' => true, 'message' => 'Account successfully removed']);
        } else {
            return response()->json(['success' => false, 'message' => 'Account not found']);
        }
    }

    public function create(Request $request)
    {
        try {
            $info = $request->only('account_number', 'broker_name', 'password');

            $isThrow = false;
            if(isset($request['is_throw']))
                $isThrow = $request['is_throw'];

            $rules = [
                'account_number' => 'required|numeric',
                'broker_name' => 'required',
                'password' => 'required|min:6',
            ];
            $validator = Validator::make($info, $rules);
            if ($validator->fails()) {
                return response()->json(['success' => false, 'message' => $validator->messages()]);
            }

            $account = Account::where([['account_number', $request['account_number']], ['user_id', $request->user()->id]])->first();

            if ($account != false) {
                return response()->json(['success' => false, 'message' => 'Account exists']);
            }

            $account = Account::create(
                [
                'account_number' => $request['account_number'],
                'password' => $request['password'],
                'broker_server_name' => $request['broker_name'],
                'user_id' => $request->user()->id,
                'creator_id' => $request->user()->id,
                'manager_id' => $request->user()->manager_id,
                'api_server_ip' => ApiServer::first()->ip,
                'account_status' => AccountStatus::PENDING,
            ]
            );
            return response()->json(['success' => true, 'account' => $account]);

        } catch (\Exception $e) {
            //$this->updateApiEvent('callback', $e->getMessage());
            if($isThrow)
                throw $e;
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function updateStatus(Request $request, $id, $status) {
        $account = Account::where([['id', $id], ['user_id', $request->user()->id]])->first();

        if ($account == false) {
            return response()->json(['success' => false, 'message' => 'Account not found']);
        }

        $account->account_status = $status;
        $account->save();

        return response()->json(['success' => true, 'Successfully updated']);
    }

    public function updateStatusByNumber(Request $request, $accountNumber, $status) {
        $account = Account::whereAccountNumber($accountNumber)->first();

        if ($account == false) {
            return response()->json(['success' => false, 'message' => 'Account not found']);
        }

        $account->account_status = $status;
        $account->save();

        return response()->json(['success' => true, 'message' => 'Successfully updated']);
    }

    public function update(Request $request, $id)
    {
        $info = $request->only('account_number', 'broker_name', 'password');
        $rules = [
            'account_number' => 'required|numeric',
            'password' => 'min:6',
        ];
        $validator = Validator::make($info, $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->messages()]);
        }

        $account = Account::where([['id', $id], ['user_id', $request->user()->id]])->first();

        if ($account == false) {
            return response()->json(['success' => false, 'message' => 'Account not found']);
        }

        $account->fill($request->all());
        $account->account_status = AccountStatus::PENDING;
        $account->save();

        return response()->json(['success' => true, 'account' => $account]);
    }

    public function uploadStat(Request $request, int $accountNumber ) {

        $account = AccountStat::firstOrNew(['account_number'=>$accountNumber]);

        $account->account_number = $accountNumber;
        $account->fill($request->except('api_token'));
        $account->save();

        return response()->json(['success' => true, 'message' => 'uploaded' ]);
    }
}