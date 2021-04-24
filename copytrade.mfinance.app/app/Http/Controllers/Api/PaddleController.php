<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\LicenseCancelMail;
use App\Mail\LicenseMail;
use App\ManagerMailer;
use App\Models\LicensePreset;
use App\Models\Member;
use App\Models\MemberProduct;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class PaddleController extends Controller
{
    public function test(Request $request)
    {
        try {
            Log::info('paddle got request', $request->all());
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }

        return response()->json(['success' => true, 'message' => 'Processed: ']);
    }

    private function subscription_cancel($managerId, $email) {
        // $package = LicensePreset::find($packageId);

        // if ($package == false || $package->manager_id != $managerId) {
        //     return response()->json(['success' => false, 'message' => 'Package does not exist or does not belong to you']);
        // }

        $user = User::where('email', $email)->where('manager_id', $managerId)->first();

        if(!$user) {
            return response()->json(['success' => false, 'message' => 'user not found']);
        }

        $member = Member::where('user_id', $user->id);

        if(!$member) {
            return response()->json(['success' => false, 'message' => 'membership not found']);
        }

        $member->delete();
        $user->delete();

        // ManagerMailer::handle(
        //     $email,
        //     new LicenseCancelMail(
        //         $user->name,
        //         $managerId
        //     )
        // );

        return response()->json(['success' => true, 'message' => 'paddle cancelled.']);
    }

    private function user_create($managerId, $email, $name, $orderId) {

        $userName = Str::before($orderId, '-');

        User::firstOrCreate(
            ['username' => $userName],
            [
                'username' => $userName,
                'name' => $name,
                'email' => $email,
                'password' => bcrypt($email),
                'manager_id' => $managerId,
                'creator_id' => $managerId,
            ]
        );

        return response()->json(['success' => true, 'message' => 'paddle. user created']);
    }

    private function subscription_create($managerId, $orderId, $packageId) {
        $package = LicensePreset::find($packageId);

        if ($package == false || $package->manager_id != $managerId) {
            return response()->json(['success' => false, 'message' => 'Package does not exist or does not belong to you']);
        }

        $user = User::where( 'username', $orderId)->first();

        if(!$user) {
            Log::error('paddle. user not found.', ['order_id'=>$orderId, 'package_id' => $package]);
            return response()->json(['success' => false, 'message' => 'user not found. order id: '. $orderId], 500);
        }

        $member = Member::firstOrCreate(
            ['user_id' => $user->id],
            [
                'license_key' => Member::GenerateLicenseKey(),
                'expiration_days' => $package->expiration_days,
                'expired_at' => Carbon::Now()->addDays($package->expiration_days),
                'max_live_accounts' => $package->max_live_accounts,
                'max_demo_accounts' => $package->max_demo_accounts,
                'single_pc' => $package->single_pc,
                'auto_confirm_new_accounts' => $package->auto_confirm_new_accounts
            ]
        );

        $member->products()->delete();

        $productKeys = array();

        //dd($package->products()->get());
        foreach ($package->products()->get() as $product) {
            $m = new MemberProduct;

            $m->member_id = $member->id;
            $m->product_id = $product->id;
            $m->Save();

            $productKeys[] = $product->key;
        }

        // ManagerMailer::handle(
        //     $user->email,
        //     new LicenseMail(
        //         $user->name,
        //         $member->license_key,
        //         $member->expired_at,
        //         $package->title,
        //         $package->description,
        //         $productKeys,
        //         $managerId
        //     )
        // );

        return response($member->license_key);
    }

    public function process(Request $request)
    {
        try {

            Log::info('paddle request.', $request->all());

            $alert = $request->alert_name;

            if($alert == 'subscription_payment_succeeded') {
                $info = $request->only('customer_name', 'email', 'order_id', 'package_id');
                $rules = [
                    'email' => 'required|email',
                    'customer_name' => 'required',
                    'order_id'  => 'required',
                ];
                $validator = Validator::make($info, $rules);
                if ($validator->fails()) {
                    return response()->json(['success' => false, 'message' => $validator->messages()]);
                }

                return $this->user_create($request->user()->id,
                    $request->email,
                    $request->customer_name,
                    $request->order_id
                );

                // return $this->subscription_create($request->user()->id,
                //     $request->email,
                //     $request->customer_name,
                //     $request->package_id
                // );
            }

            if($alert == 'subscription_cancelled') {
                $info = $request->only('email');
                $rules = [
                    'email' => 'required|email',
//                    'package_id'  => 'required',
                ];
                $validator = Validator::make($info, $rules);
                if ($validator->fails()) {
                    return response()->json(['success' => false, 'message' => $validator->messages()]);
                }

                return $this->subscription_cancel(
                    $request->user()->id,
                    $request->email
  //                  $request->package_id
                );
            }

            if($request->has('p_order_id')) {
                return $this->subscription_create(
                    $request->user()->id,
                    $request->p_order_id,
                    $request->package_id
                );
            }

        } catch (\Exception $e) {
            Log::error($e, $request->all());
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
