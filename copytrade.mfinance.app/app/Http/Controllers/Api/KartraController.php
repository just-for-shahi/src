<?php

namespace App\Http\Controllers\Api;

use Hash;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use App\Models\UserExpertSubscription;
use App\Models\ExpertSubscription;
use App\Models\CopierSubscription;
use App\Models\UserCopierSubscription;
use App\Models\CopierSubscriptionDestAccount;
use App\Models\AccountStatus;
use App\Models\Account;
use App\Mail\WelcomeMail;

class KartraController extends Controller
{
    public function process(Request $request)
    {
        try {
            $post = file_get_contents('php://input');
            //Log::error($post);

            $object = json_decode($post);

            $action = $object->action;
            $actionDetails = $object->action_details;

            $managerId = $request->user()->id;
            $managerTheme = $request->user()->theme;
            $isThrow = false;
            if(isset($request['is_throw']))
                $isThrow = $request['is_throw'];
            $data = [];

            if ($action == 'buy_product') {
                $transaction = $actionDetails->transaction_details;
                $name = $transaction->buyer_first_name . ' ' . $transaction->buyer_last_name;
                $email = $transaction->buyer_email;

                $product = $transaction->product_name;

                $this->addToCopierSubscription($managerId, $product, $email, $name);
            }

            if ($action == 'cancel_subscription') {
                $transaction = $actionDetails->transaction_details;
                $email = $transaction->buyer_email;

                $product = $transaction->product_name;

                $this->removeFromCopierSubscription($managerId, $product, $email);
            }

            if ($action == 'membership_granted') {
                $password = '';
                if(isset($request['password']))
                    $password = $request['password'];
                $membership = $actionDetails->membership;
                $levelName = $membership->level_name;
    
                $lead = $object->lead;
                $firstName = $lead->first_name;
                $lastName = $lead->last_name;
                $name = $firstName . ' ' .$lastName;
                $email = $lead->email;
    
                $data = $this->addToExpertSubscription($managerId, $managerTheme, $levelName, $email, $name, $password);
            }

            if ($action == 'membership_revoked') {
                $membership = $actionDetails->membership;
                $levelName = $membership->level_name;
    
                $lead = $object->lead;
                $email = $lead->email;
    
                $this->removeFromExpertSubscription($managerId, $levelName, $email);
            }
        } catch (\Exception $e) {
            //$this->updateApiEvent('callback', $e->getMessage());
            if($isThrow)
                throw $e;
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }

        return response()->json(['success' => true, 'message' => 'Processed: '.$post, 'data' => $data]);
    }

    private function addToExpertSubscription($managerId, $managerTheme, $levelName, $email, $name, $password)
    {
        $conf = config('kartra.levels_subscription_matching');

        $subscriptionId = $conf[$levelName];

        $user = User::where([['email', $email], ['manager_id', $managerId]])->first();

        $is_new_user = false;
        if ($user == false) {
            $is_new_user = true;
            $user = new User();
            $user->email = $email;
            $user->name = $name;
            $user->username = $email;
            $user->manager_id = $managerId;
            $user->creator_id = $managerId;

            if(empty($password))
            {
                $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ234567890!$%^&!$%^&');
                $password = substr($random, 0, 10);
            }

            $user->password = Hash::make($password);
            $user->save();
        } else {
            if(!empty($password)) {
                $user->password = Hash::make($password);
                $user->save();
            }
        }

        $expertSubscription = ExpertSubscription::find($subscriptionId);

        $expireDays = $expertSubscription->expire_days;

        $subscription = UserExpertSubscription::where([
            ['expert_subscription_id', $subscriptionId],
            ['user_id', $user->id],
            ])
            ->first();

        if ($subscription == false) {
            $subscription = new UserExpertSubscription();

            $subscription->user_id = $user->id;

            if (!empty($expireDays)) {
                $date = Carbon::now()->addDays($expireDays);
                $subscription->expired_at = $date;
            }
            $subscription->expert_subscription_id = $subscriptionId;
        }

        $subscription->save();
        $user = User::with('expertsubscriptions')->find($user->id);

        $data = array();
        $data['name'] = $user->name;
        $data['email'] = $user->email;
        $data['password'] = $password;
        $data['url'] = admin_url('/');

        if ($is_new_user) {
            \Mail::to($email)->send(new WelcomeMail($data, $managerTheme));
        }

        return $data;
    }

    private function addToCopierSubscription($managerId, $levelName, $email, $name)
    {
        $conf = config('kartra.levels_subscription_matching');

        $subscriptionId = $conf[$levelName];

        $user = User::where([['email', $email], ['manager_id', $managerId]])->first();

        $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ234567890!$%^&!$%^&');
        $password = substr($random, 0, 10);

        $is_new_user = false;
        if ($user == false) {
            $is_new_user = true;
            $user = new User();
            $user->email = $email;
            $user->name = $name;
            $user->username = $email;
            $user->manager_id = $managerId;
            $user->creator_id = $managerId;
            $user->password = Hash::make($password);
            $user->meta = [ 'start_page' => url('/admin/myaccounts/create') ];
            $user->save();
        }

        $subscription = CopierSubscription::find($subscriptionId);

        $subscription = UserCopierSubscription::where([
            ['copier_subscription_id', $subscriptionId],
            ['user_id', $user->id],
            ])
            ->first();

        if ($subscription == false) {
            $subscription = new UserCopierSubscription();

            $subscription->user_id = $user->id;
            $subscription->copier_subscription_id = $subscriptionId;
        }

        $subscription->save();
        $user = User::with('copiersubscriptions')->find($user->id);

        $data = array();
        $data['name'] = $user->name;
        $data['email'] = $user->email;
        $data['password'] = $password;
        $data['url'] = admin_url('/');

        if ($is_new_user) {
            \Mail::to($email)->send(new WelcomeMail($data));
        }
    }

    private function removeFromExpertSubscription($managerId, $levelName, $email)
    {
        $conf = config('kartra.levels_subscription_matching');

        $subscriptionId = $conf[$levelName];

        $user = User::where([['email', $email], ['manager_id', $managerId]])->first();

        if (!$user) {
            return;
        }

        $subscription = UserExpertSubscription::where([
            ['expert_subscription_id', $subscriptionId],
            ['user_id', $user->id],
            ])
            ->first();

        if ($subscription) {
            $accounts = Account::where('user_id', $user->id)->get();
            foreach($accounts as $account) {
                $account->account_status = AccountStatus::REMOVING;
                $account->save();
            }
            $subscription->delete();
        }
    }

    private function removeFromCopierSubscription($managerId, $levelName, $email)
    {
        $conf = config('kartra.levels_subscription_matching');

        $subscriptionId = $conf[$levelName];

        $user = User::where([['email', $email], ['manager_id', $managerId]])->first();

        if (!$user) {
            return;
        }

        $subscription = UserCopierSubscription::where([
            ['copier_subscription_id', $subscriptionId],
            ['user_id', $user->id],
            ])
            ->first();

        if ($subscription) {
            $subscription->delete();
        }

        $copier = CopierSubscriptionDestAccount::where([
            ['copier_subscription_id', $subscriptionId],
            ['user_id', $user->id]])
            ->first();

        if ($copier) {
            $account = Account::find($copier->account_id);
            $account->account_status = AccountStatus::PENDING;
            $account->save();

            $copier->delete();
        }
    }
}
