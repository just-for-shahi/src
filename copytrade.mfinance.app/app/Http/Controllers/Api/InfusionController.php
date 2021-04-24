<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeMail;
use App\ManagerMailer;
use App\Models\Account;
use App\Models\AccountStatus;
use App\Models\CopierSubscriptionDestAccount;

use App\Models\UserCopierSubscription;
use App\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;


class InfusionController extends Controller
{
    public function process(Request $request)
    {
        try {
            $post = file_get_contents('php://input');
            Log::error($post);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }

        return response()->json(['success' => true, 'message' => 'Processed: '.$post]);
    }

    public function remove(Request $request)
    {
        $info = $request->only('email'
    //    'tag_id'
    );
        $rules = [
            'email' => 'required|email',
      //      'tag_id' => 'required',
        ];
        $validator = Validator::make($info, $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->messages()]);
        }

        $user = User::where([['email', $request['email']], ['manager_id', $request->user()->id]])->first();

        if ($user == false) {
            return response()->json(['success' => true]);
        }

        $tag_id = $request->tag_id;

        $ids = [42];
        // if($tag_id == 610) {
        //     $ids[] = 42;
        // } else {
        //     return response()->json(['success' => true,'tag_id' => $tag_id]);
        // }

        $subscriptions = UserCopierSubscription::whereUserId($user->id)->whereIn('copier_subscription_id', $ids)->get();

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


    public function add(Request $request) {
        $info = $request->only('email', 'name'
    //    'tag_id'
    );
        $rules = [
            'email' => 'required|email',
            'name' => 'required',
            //'tag_id' => 'required',
        ];
        $validator = Validator::make($info, $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->messages()]);
        }

        $email = $request->email;
        $name = $request->name;
      //  $tag_id = $request->tag_id;
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


        $ids = [42];
        //if($tag_id == 610) {
            //$ids[] = 42;
        // } else {
        //     return response()->json(['success' => true,'tag_id' => $tag_id]);
        // }

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
}