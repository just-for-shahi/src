<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeMail;
use App\ManagerMailer;
use App\Models\EmailSubscription;
use App\Models\EmailSubscriptionGroup;
use App\Models\UserEmailSubscription;
use App\Models\UserSubscriptionSetting;
use App\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmailSubscriptionController extends Controller
{

    public function groupsAll(Request $request)
    {
        return response()->json([
            'success' => true,
            'list' => EmailSubscriptionGroup::where('manager_id', $request->user()->id)->get()
        ]);
    }

    public function listAll(Request $request)
    {
        return response()->json([
            'success' => true,
            'list' => EmailSubscription::where('manager_id', $request->user()->id)->get()
        ]);
    }

    public function get(Request $request, $id)
    {
        return response()->json([
            'success' => true,
            'item' => EmailSubscription::find($id)
        ]);
    }

    public function getGroup(Request $request, $id)
    {
        return response()->json([
            'success' => true,
            'item' => EmailSubscriptionGroup::find($id)
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

        $ids = $request['ids'];
        $ids = explode(',', $ids);

        foreach ($ids as $id) {
            $subscription = UserEmailSubscription::where([['email_subscription_id', $id],['user_id', $user->id]])->first();

            if ($subscription == false) {
                $subscription = new UserEmailSubscription();

                $subscription->user_id = $user->id;
                $subscription->email_subscription_id = $id;
                $subscription->email = $request['email'];
            }

            $subscription->enabled = 1;
            $subscription->save();
        }

        $user = User::with('emailsubscriptions')->find($user->id);

        $data = array();
        $data['name'] = $user->name;
        $data['email'] = $user->email;
        $data['password'] = $password;
        $data['url'] = admin_url('/');

        if ($is_new_user) {

            ManagerMailer::handle(
                $user->email,
                new WelcomeMail(
                    $user->email,
                    $user->name,
                    $password,
                    admin_url('/'),
                    $request->user()->id)
            );
        }

        return response()->json(['success' => true, 'user' => $user]);
    }

    public function createForGroup(Request $request)
    {
        $info = $request->only('email', 'name', 'id', 'max_subscriptions');
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
                ['max_email_subscriptions' => $request['max_subscriptions']]
            );
        }

        $group_id = $request['id'];
        $subscriptions = EmailSubscriptionGroup::find($group_id)->subscriptions()->get(['id']);

        foreach ($subscriptions as $sub) {
            $subscription = UserEmailSubscription::where([['email_subscription_id', $sub->id],['user_id', $user->id]])->first();

            if ($subscription == false) {
                $subscription = new UserEmailSubscription();

                $subscription->user_id = $user->id;
                $subscription->email_subscription_id = $sub->id;
                $subscription->email = $request['email'];
            }

            $subscription->enabled = 1;
            $subscription->save();
        }

        $user = User::with('emailsubscriptions')->find($user->id);

        $data = array();
        $data['name'] = $user->name;
        $data['email'] = $user->email;
        $data['password'] = $password;
        $data['url'] = admin_url('/');

        if ($is_new_user) {
            ManagerMailer::handle(
                $user->email,
                new WelcomeMail(
                    $user->email,
                    $user->name,
                    $password,
                    admin_url('/'),
                    $request->user()->id)
            );
        }

        return response()->json(['success' => true, 'user' => $user]);
    }

    public function update(Request $request)
    {
        $info = $request->only('email', 'email_subscriptions_id', 'enabled');
        $rules = [
            'email' => 'required',
            'email_subscriptions_id' => 'required|numeric',
            'enabled' => 'required',
        ];
        $validator = Validator::make($info, $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->messages()]);
        }

        $subscription = UserEmailSubscription::where([
            ['email', $request['email']],
            ['email_sucbription_id' => $request['email_sucbription_id']],
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
            $subscriptions = UserEmailSubscription::where([['user_id', $user->id]])->get();
        } else {
            $ids = explode(',', $ids);

            $subscriptions = UserEmailSubscription::whereUserId($user->id)->whereIn('email_subscription_id', $ids)->get();
        }

        foreach ($subscriptions as $subscription) {
            $subscription->delete();
        }

        return response()->json(['success' => true]);
    }
}
