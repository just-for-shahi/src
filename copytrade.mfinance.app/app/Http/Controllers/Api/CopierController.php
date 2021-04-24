<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hash;
use App\Models\Account;
use App\Models\UserCopierSubscription;
use App\Models\CopierSubscriptionDestAccount;
use App\User;
use App\Models\CopierSubscription;
use App\Models\ApiServer;
use App\Models\AccountStatus;
use Illuminate\Support\Facades\Validator;

class CopierController extends Controller
{
    public function add(Request $request)
    {
        $info = $request->only('email', 'account_number', 'broker_name', 'password', 'copier_subscription_id');
        $rules = [
            'account_number' => 'required|numeric',
            'broker_name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ];
        $validator = Validator::make($info, $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->messages()]);
        }

        $subscription = CopierSubscription::find($request['copier_subscription_id']);

        if ($subscription == false) {
            return response()->json(['success' => false, 'message' => 'Copier Subscription does not exists']);
        }

        $user = User::where([['email', $request['email']]])->first();

        if ($user != false) {
            return response()->json(['success' => false, 'message' => 'User exists']);
        }

        $roleModel = config('admin.database.roles_model');
        $userRole = $roleModel::whereName('User')->first();

        $user = User::create([
            'username' => $request['email'],
            'name' => $request['email'],
            'email' => $request['email'],
            'creator_id' => $request->user()->id,
            'manager_id' => $request->user()->id,
            'password' => Hash::make($request['password']),
            'role' => $userRole->id,
        ]);
        $user->roles()->save($userRole);

        UserCopierSubscription::create([
            'copier_subscription_id' => $subscription->id,
            'user_id' => $user->id,
        ]);

        $account = Account::where([['account_number', $request['account_number']], ['user_id', $user->id]])->first();

        if ($account != false) {
            return response()->json(['success' => false, 'message' => 'Account exists']);
        }

        $account = Account::create([
            'account_number'=>$request['account_number'],
            'password'=>$request['password'],
            'broker_server_name'=>$request['broker_name'],
            'api_server_ip'=> ApiServer::first()->ip,
            'user_id'=> $user->id,
            'creator_id'=> $user->id,
            'manager_id' => $request->user()->id,
        ]);

        CopierSubscriptionDestAccount::create([
            'user_id' => $user->id,
            'creator_id' => $user->id,
            'account_id' => $account->id,
            'copier_subscription_id' => $subscription->id,
            'risk_type' => empty($request['risk_type']) ? $subscription->risk_type : $request['risk_type'],
            'fixed_lot' => empty($request['fixed_lot']) ? $subscription->fixed_lot : $request['fixed_lot'],
            'lots_multiplier' => empty($request['lots_multiplier']) ? $subscription->lots_multiplier : $request['lots_multiplier'],
            'max_lots_per_trade' => $subscription->max_lots_per_trade,
            'money_ratio_lots' => empty($request['money_ratio_lots']) ? $subscription->money_ratio_lots : $request['money_ratio_lots'],
            'money_ratio_dol' => empty($request['money_ratio_dol']) ? $subscription->money_ratio_dol : $request['money_ratio_dol'],
            'price_diff_accepted_pips' => $subscription->price_diff_accepted_pips,
            'min_balance' => $subscription->min_balance,
            'scaling_factor' => empty($request['scaling_factor']) ? $subscription->scaling_factor : $request['scaling_factor'],
            'max_lots_per_trade' => empty($request['max_lots_per_trade']) ? $subscription->max_lots_per_trade : $request['max_lots_per_trade'],
            'live_time' => $subscription->live_time,
            'enabled' => 1,
        ]);

        $account->account_status = AccountStatus::PENDING;
        $account->save();

        return response()->json(['success' => true, 'message' => 'Successfully created']);
    }

    public function update(Request $request, $id)
    {
        $info = $request->only('account_number', 'broker_name', 'password');
        $rules = [
            'account_number' => 'numeric',
            'broker_name' => 'required',
            'password' => 'min:6',
        ];
        $validator = Validator::make($info, $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->messages()]);
        }

        $account = Account::where([['id', $id], ['user_id', $request->user()->id]])->first();

        if ($account == false) {
            return response()->json(['succss' => false, 'message' => 'Account not found']);
        }

        $account->fill($request->all());
        $account->account_status = AccountStatus::PENDING;
        $account->save();

        return response()->json(['success' => true, 'account' => $account]);
    }
}
