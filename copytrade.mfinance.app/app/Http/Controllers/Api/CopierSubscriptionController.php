<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeMail;
use App\ManagerMailer;
use App\Models\Account;
use App\Models\AccountStatus;
use App\Models\CopierSubscription;
use App\Models\CopierSubscriptionDestAccount;

use App\Models\CopierSubscriptionGroup;
use App\Models\CopierSubscriptionSourceAccount;
use App\Models\UserCopierSubscription;
use App\Models\UserSubscriptionSetting;
use App\User;
use Hash;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CopierSubscriptionController extends Controller
{

    public function groupsAll(Request $request)
    {
        return response()->json([
            'success' => true,
            'list' => CopierSubscriptionGroup::where('manager_id', $request->user()->id)->get()
        ]);
    }

    public function listAll(Request $request)
    {
        return response()->json([
            'success' => true,
            'list' => CopierSubscription::where('manager_id', $request->user()->id)->get()
        ]);
    }

    public function get(Request $request, $id)
    {
        return response()->json([
            'success' => true,
            'item' => CopierSubscription::find($id)
        ]);
    }

    public function getGroup(Request $request, $id)
    {
        return response()->json([
            'success' => true,
            'item' => CopierSubscriptionGroup::find($id)
        ]);
    }

    public function getForMaster(Request $request, $accountIdMaster)
    {
        $items = Account::find($accountIdMaster)
            ->destinations()
            ->get(['scope_key', 'title'])
            ->makeHidden('pivot');

        return response()->json([
            'success' => true,
            'items' => $items
        ]);
    }

    public function getForSlave(Request $request, $accountIdSlave)
    {
        $items = CopierSubscriptionDestAccount::with('subscription:id,scope_key')
            ->whereAccountId($accountIdSlave)
            ->get()
            ->makeHidden('pivot');

        return response()->json([
            'success' => true,
            'items' => $items
        ]);
    }

    public function create(Request $request)
    {
        $info = $request->only('email', 'name', 'ids');
        $rules = [
            'email' => 'required|email',
            'name' => 'required',
            'ids' => 'required',
        ];
        $validator = Validator::make($info, $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->messages()]);
        }

        $email = $request->email;
        $name = $request->name;
        $ids = $request->ids;
        $password = $request->password;

        $user = User::where([['email', $email], ['manager_id', $request->user()->id]])->first();

        if (empty($password)) {
            $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ234567890!$%^&!$%^&');
            $password = substr($random, 0, 10);
        } else {
            $password = $password;
        }

        $is_new_user = false;
        if ($user == false) {
            $is_new_user = true;
            $user = new User();
            $user->email = $email;
            $user->name = $name;
            $user->username = $email;
            $user->manager_id = $request->user()->id;
            $user->creator_id = $request->user()->id;
            $user->password = Hash::make($password);
            $user->save();
        }

        $ids = explode(',', $ids);

        foreach ($ids as $id) {
            $subscription = UserCopierSubscription::where([['copier_subscription_id', $id],['user_id', $user->id]])->first();

            if ($subscription == false) {
                $subscription = new UserCopierSubscription();

                $subscription->user_id = $user->id;
                $subscription->copier_subscription_id = $id;
            }

            $subscription->save();
        }

        if ($is_new_user) {

            ManagerMailer::handle(
                $email,
                new WelcomeMail(
                    $email,
                    $name,
                    $password,
                    admin_url('/'),
                    $request->user()->id)
            );

        }

        return response()->json(['success' => true, 'user' => $user]);
    }

    public function update(Request $request)
    {
        $info = $request->only('email', 'copier_subscriptions_id', 'enabled');
        $rules = [
            'email' => 'required',
            'copier_subscriptions_id' => 'required|numeric',
            'enabled' => 'required',
        ];
        $validator = Validator::make($info, $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->messages()]);
        }

        $subscription = UserCopierSubscription::where([
            ['email', $request['email']],
            ['copier_subscriptions_id' => $request['copier_subscriptions_id']]
            ])->first();

        if ($subscription == false) {
            return response()->json(['succss' => false, 'message' => 'Subscription not found']);
        }

        $subscription->enabled = $request['enabled'];
        $subscription->save();

        return response()->json(['success' => true, 'subscription' => $subscription]);
    }

    public function delete(Request $request)
    {
        $info = $request->only('email', 'ids');
        $rules = [
            'email' => 'required|email',
            'ids' => 'required',
        ];
        $validator = Validator::make($info, $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->messages()]);
        }

        $user = User::where([['email', $request['email']], ['manager_id', $request->user()->id]])->first();

        if ($user == false) {
            return response()->json(['success' => true]);
        }

        $ids = $request['ids'];

        if ($ids == 'all') {
            $subscriptions = UserCopierSubscription::whereUserId($user->id)->get();
        } else {
            $ids = explode(',', $ids);

            $subscriptions = UserCopierSubscription::whereUserId($user->id)->whereIn('copier_subscription_id', $ids)->get();
        }

        foreach ($subscriptions as $subscription) {
            $copiers = CopierSubscriptionDestAccount::
                where('copier_subscription_id', $subscription->id)
                ->whereHas('account', function ($q) use ($user) {
                    $q->whereUserId($user->id);
                })
                ->get();
            foreach ($copiers as $copier) {
                $account = Account::find($copier->account_id);
                $account->account_status = AccountStatus::PENDING;
                $account->save();
                $copier->delete();
            }
            $subscription->delete();
        }

        return response()->json(['success' => true]);
    }

    public function createForGroup(Request $request)
    {
        $info = $request->only('email', 'name', 'id', 'max_subscriptions', 'max_accounts');
        $rules = [
            'email' => 'required|email',
            'name' => 'required',
            'id' => 'required',
        ];

        $validator = Validator::make($info, $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->messages()]);
        }

        $user = User::where([['email', $request['email']], ['manager_id', $request->user()->id]])->first();

        if (empty($request['password'])) {
            $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ234567890!$%^&!$%^&');
            $password = substr($random, 0, 10);
        } else {
            $password = $request['password'];
        }

        $is_new_user = false;
        if ($user == false) {
            $is_new_user = true;
            $user = new User();
            $user->email = $request['email'];
            $user->name = $request['name'];
            $user->username = $request['email'];
            $user->manager_id = $request->user()->id;
            $user->creator_id = $request->user()->id;
            $user->password = Hash::make($password);
            $user->save();
        }

        if( isset($request['max_subscriptions']) && !empty($request['max_subscriptions'])) {
            UserSubscriptionSetting::updateOrCreate(
                ['user_id' => $user->id],
                ['max_copier_subscriptions' => $request['max_subscriptions']]
            );
        }

        if( isset($request['max_accounts']) && !empty($request['max_accounts'])) {
            UserSubscriptionSetting::updateOrCreate(
                ['user_id' => $user->id],
                ['max_accounts' => $request['max_accounts']]
            );
        }

        $group_id = $request['id'];
        $subscriptions = CopierSubscriptionGroup::find($group_id)->subscriptions()->get(['id']);

        foreach ($subscriptions as $sub) {
            $subscription = UserCopierSubscription::where([['copier_subscription_id', $sub->id],['user_id', $user->id]])->first();

            if ($subscription == false) {
                $subscription = new UserCopierSubscription();

                $subscription->user_id = $user->id;
                $subscription->copier_subscription_id = $sub->id;
            }

            $subscription->save();
        }
        $user = User::with('copiersubscriptions')->find($user->id);

        $data = array();
        $data['name'] = $user->name;
        $data['email'] = $user->email;
        $data['password'] = $password;
        $data['url'] = admin_url('/');

        if ($is_new_user) {
            \Mail::to($request['email'])->send(new WelcomeMail($data));
        }

        return response()->json(['success' => true, 'user' => $user]);
    }
}
