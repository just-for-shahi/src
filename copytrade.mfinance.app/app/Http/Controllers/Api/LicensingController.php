<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Mail\WelcomeCampaignMail;
use App\ManagerMailer;
use App\Models\Account;
use App\Models\Campaign;

use App\Models\LicensePreset;
use App\Models\Licensing;
use App\Models\Member;
use App\Models\MemberProduct;
use App\Models\MemberProductAccount;
use App\Models\Product;
use App\Models\ProductFile;
use App\Models\ProductOption;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Stevebauman\Location\Facades\Location;
use Zip;

class LicensingController extends Controller
{

    public function listPackages(Request $request)
    {
        return response()->json([
            'success' => true,
            'list' => LicensePreset::where('manager_id', $request->user()->id)->get()
        ]);
    }

    public function deleteMember(Request $request)
    {

        try {
            $credentials = $request->only('email');
            $rules = [
                'email' => 'required|email|max:255'
            ];
            $validator = Validator::make($credentials, $rules);
            if ($validator->fails()) {
                return response()->json(['success' => false, 'message' => $validator->messages()]);
            }
            $email = $request->email;

            $user = User::whereEmail($email)->whereManagerId($request->user()->id)->first();
            if ($user == false) {
                return response()->json(['success' => false, 'message' => 'User not found']);
            }

            $member = Member::whereUserId($user->id)->first();

            if ($member == false) {
                return response()->json(['success' => false, 'message' => 'Member not found']);
            }

            $member->delete();

            // ManagerMailer::handle(
            //     $email,
            //     new LeaveMemberMail(
            //         $user->name,
            //         $request->user()->id
            //     )
            // );

            return response()->json(['success' => true, 'message' => 'Member deleted.']);
        } catch (\Exception $e) {
            Log::error($e);
//            throw $e;
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }


    public function addMember(Request $request)
    {

        try {
            $credentials = $request->only('name', 'email', 'package_id');
            $rules = [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255',
                'package_id' => 'required',
            ];
            $validator = Validator::make($credentials, $rules);
            if ($validator->fails()) {
                return response()->json(['success' => false, 'message' => $validator->messages()]);
            }
            $name = $request->name;
            $email = $request->email;
            $packageId = $request->package_id;

            $package = LicensePreset::find($packageId);

            if ($package == false || $package->manager_id != $request->user()->id) {
                return response()->json(['success' => false, 'message' => 'LicensePreset does not exist or does not belong to you']);
            }

            $user = User::firstOrCreate(
                ['username'=>$email],
                ['username' => $email,
                'name' => $name,
                'email' => $email,
                'password' => bcrypt($email),
                'manager_id'=>$request->user()->id,
                'creator_id'=>$request->user()->id,
            ]);

            $member = Member::firstOrCreate(
            ['user_id' => $user->id ],
            ['license_key' => Member::GenerateLicenseKey(),
            'expiration_days' => $package->expiration_days,
            'max_live_accounts' => $package->max_live_accounts,
            'max_demo_accounts' => $package->max_demo_accounts,
            'single_pc' => $package->single_pc,
            'auto_confirm_new_accounts' => $package->auto_confirm_new_accounts
            ]);

            $member->products()->delete();

            foreach($package->products()->get() as $product) {
                $m = new MemberProduct;

                $m->member_id = $member->id;
                $m->product_id = $product->id;
                $m->Save();
            }

            ManagerMailer::handle(
                $email,
                new WelcomeCampaignMail(
                    $user->name,
                    $package->title,
                    $package->description,
                    $member->license_key,
                    $package->expiration_days,
                    $request->user()->id
                )
            );

            return response()->json(['success' => true, 'message' => 'New member processed.']);
        } catch (\Exception $e) {
            Log::error($e);
//            throw $e;
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function prepareArchive($managerId, $productKeys)
    {

        try {

            $productKeys = explode(',',$productKeys);
            $packageName = implode('_',$productKeys);

            $files = ProductFile::whereHas('product', function($q) use ($productKeys, $managerId){
                $q->whereIn('key', $productKeys)->whereManagerId($managerId);
            })->get();

            if(count($files) < 1) {
                return response('', 404);
            }

            $zip = Zip::create($packageName.'.zip');

            $path = config('filesystems.disks.files.root').'/';

            $zip->add( $path.'lib_defender.ex4', 'Libraries/lib_defender.ex4');
            $zip->add( $path.'mt4-common.dll', 'Libraries/mt4-common.dll');
            $zip->add( $path.'zlib1.dll', 'Libraries/zlib1.dll');

            $path = config('filesystems.disks.public.root').'/';

            foreach($files as $file) {
                $zip->add( $path.$file->path, $file->type.'s/'.$file->name);
            }

            return $zip->response();


        } catch (\Exception $e) {
            Log::error($e);
            //throw $e;
            return response('', 500);
        }
    }


    public function detachAccount(Request $request)
    {

        try {
            $credentials = $request->only('license_key', 'account_number', 'product_key');
            $rules = [
                'product_key' => 'required',
                'account_number' => 'required|numeric',
                'license_key' => 'required',
            ];
            $validator = Validator::make($credentials, $rules);
            if ($validator->fails()) {
                return response()->json(['success' => false, 'message' => $validator->messages()]);
            }

  //          DB::enableQueryLog();
            $mpas = MemberProductAccount
                ::whereHas('product', function($query) use($request) {
                    return$query->where('key',$request['product_key']);
                })
                ->whereHas('member', function ($query) use($request) {
                    return $query->whereLicenseKey($request['license_key']);
                })
                //->whereHas('account', function ($query) use($request) {
                //    return $query->whereAccountNumber($request['account_number']);
                //})
                ->get();
//dd(DB::getQueryLog());

            foreach ($mpas as $mpa) {
                $mpa->confirmed = 0;
                $mpa->Save();
            }

            return response()->json(['success' => true, 'message' => 'Account detached.']);
        } catch (\Exception $e) {
            Log::error($e);
//            throw $e;
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function campaign(Request $request)
    {

        try {
            $credentials = $request->only('name', 'email', 'campaign_slug');
            $rules = [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255',
                'campaign_slug' => 'required|max:255',
            ];
            $validator = Validator::make($credentials, $rules);
            if ($validator->fails()) {
                return response()->json(['success' => false, 'message' => $validator->messages()]);
            }
            $name = $request->name;
            $email = $request->email;
            $campaignSlug = $request->campaign_slug;

            $campaign = Campaign::with('products')->where('slug',$campaignSlug)->first();

            if($campaign == false) {
                return response()->json(['success' => false, 'message' => 'Wrong campaign slug']);
            }

            $user = User::firstOrCreate(
                ['username'=>$email],
                ['username' => $email,
                'name' => $name,
                'email' => $email,
                'password' => bcrypt($email),
                'manager_id'=>$request->user()->id,
                'creator_id'=>$request->user()->id,
                ]);

            $exists = Licensing
                ::whereHas('campaign', static function ($q) use($campaignSlug) {
                    $q->whereSlug($campaignSlug);
                })
                ->whereUserId($user->id)->first();

            if($exists != false)
                return response()->json(['success' => false, 'message' => 'Email already exists in list of campaign members']);

            $lic = new Licensing;

            $lic->user_id = $user->id;
            $lic->campaign_id = $campaign->id;
            $lic->reference_source = 'rest';
            $lic->Save();

            $member = new Member;
            $member->user_id = $user->id;
            $member->license_key = Member::GenerateLicenseKey();
            $member->expiration_days = Carbon::parse($campaign->expired_at)->diffInDays(Carbon::now());
            $member->expired_at = $campaign->expired_at;
            $member->max_live_accounts = $campaign->max_live_accounts;
            $member->max_demo_accounts = $campaign->max_demo_accounts;
            $member->single_pc = $campaign->single_pc;
            $member->auto_confirm_new_accounts = $campaign->auto_confirm_new_accounts;
            $member->Save();

            foreach($campaign->products()->get() as $product) {
                $m = new MemberProduct;

                $m->member_id = $member->id;
                $m->product_id = $product->id;
                $m->Save();
            }

            $data = array();
            $data['name'] = $user->name;
            $data['campaign_title'] = $campaign->title;
            $data['campaign_description'] = $campaign->description;
            $data['license_key'] = $member->license_key;
            $data['expired_at'] = $campaign->expired_at;
            $data['expired_in'] = Carbon::parse($campaign->expired_at)->diffForHumans();

            ManagerMailer::handle(
                $email,
                new WelcomeCampaignMail(
                    $user->name,
                    $campaign->title,
                    $campaign->description,
                    $member->license_key,
                    $campaign->expired_at,
                    $request->user()->id
                )
            );

            return response()->json(['success' => true, 'message' => 'New campaign user processed.']);
        } catch (\Exception $e) {
            Log::error($e);
//            throw $e;
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function productPutFile(Request $request)
    {

        try {
            $credentials = $request->only('key', 'title', 'file_type', 'file');
            $rules = [
                'key' => 'required|max:255',
                'title' => 'required|max:255',
                'file_type' => 'required|max:10',
                'file' => 'required',
            ];
            $validator = Validator::make($credentials, $rules);
            if ($validator->fails()) {
                return response()->json(['success' => false, 'message' => $validator->messages()]);
            }
            $key = $request->key;
            $title = $request->title;
            $fileType = $request->file_type;
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();

            $product = Product::firstOrCreate(
                ['key'=>$key, 'manager_id'=> $request->user()->id],
                ['key'=>$key, 'title'=>$title, 'manager_id'=> $request->user()->id]);

            if($product->wasRecentlyCreated) {
                $preset = new LicensePreset;
                $preset->title = $title.' Demo only (week)';
                $preset->max_demo_accounts = 1;
                $preset->max_live_accounts = 0;
                $preset->expiration_days = 7;
                $preset->manager_id = $request->user()->id;

                $preset->Save();

                $preset->products()->attach($product);

                $preset = new LicensePreset;
                $preset->title = $title.' Live only (week)';
                $preset->max_demo_accounts = 0;
                $preset->max_live_accounts = 1;
                $preset->expiration_days = 7;
                $preset->manager_id = $request->user()->id;

                $preset->Save();

                $preset->products()->attach($product);
            }

            $productFile = ProductFile::firstOrNew(
                ['name'=>$fileName, 'product_id'=>$product->id, 'type'=> $fileType],
                ['name'=>$fileName, 'product_id'=>$product->id, 'type' => $fileType]
            );

            $disk = Storage::disk(config('admin.upload.disk'));

            $disk->exists($request->user()->id) || $disk->makeDirectory($request->user()->id);

            $fName = $request->user()->id.'/'.$fileName;
            $disk->exists($fName) && $disk->delete($fName);

            $disk->put($fName, file_get_contents($file));

            $productFile->path = $fName;
            $productFile->Save();

            return response()->json(['success' => true, 'message' => 'New product file is uploaded.']);
        } catch (\Exception $e) {
            Log::error($e);
//            throw $e;
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function auth(Request $request)
    {
        try {

            $info = $request->only('account_number', 'broker_name', 'license_key','product_key',
                '_d', 'is_live', 'mac');

            $rules = [
                'product_key' => 'required',
                'account_number' => 'required|numeric',
                'is_live' => 'required|numeric',
                'broker_name' => 'required',
                'license_key' => 'required',
                'mac' => 'required'
            ];
            $validator = Validator::make($info, $rules);
            if ($validator->fails()) {
                return response()->json(['success' => false, 'message' => $validator->messages()]);
            }

            $productId = 0;
            $countAccounts = 0;

            $isAccountLive = $request['is_live'] == 1;
            $productKey = $request['product_key'];
            $licenseKey = $request['license_key'];
            $brokerName = $request['broker_name'];
            $accountNumber = $request['account_number'];
            $mac = $request['mac'];
            $isEncode = $request['_d'] != 1;

            $member = Member
                ::with('products')
                //->with('brokers')
                ->with('accounts:account_number,is_live')
                ->where('license_key',$licenseKey)
                ->first();

            if(!$member) {
                return response()->json(['success' => false, 'message' => 'License is not valid']);
            }

            //print_r( Carbon::parse($member->expired_at));
            //print_r(Carbon::Now());
            //die;
            if( $member->expiration_days != -1 && Carbon::parse($member->expired_at)->lt(Carbon::Now())) {
                return response()->json(['success' => false, 'message' => 'License is expired']);
            }

            if($member->single_pc && ( !is_null($member->MAC) && $mac != $member->MAC)) {
                return response()->json([
                    'success' => false,
                    'code'=> 102,
                    'message' => 'License is already activated on another machine']);
            }

            $okProduct = false;
            foreach($member->products()->get() as $product) {
                if($product->key == $productKey) {
                    $productId = $product->id;
                    $okProduct = true;
                    break;
                }
            }

            if(!$okProduct) {
                return response()->json(['success' => false, 'message' => 'License is not valid for this Product']);
            }

            $brokers = $member->brokers()->get();
            if($brokers->count() > 0) {
                $okBroker = false;
                foreach($brokers as $broker) {
                    if($broker->broker_name == $brokerName) {
                        $okBroker = true;
                        break;
                    }
                }

                if(!$okBroker) {
                    return response()->json([
                        'success' => false,
                        'code'=> 103,
                        'message' => 'License is not valid for this Broker'
                    ]);
                }
            }

            $accounts = $member->accounts()->get();
            foreach($accounts as $account) {

                if($account->pivot->confirmed == 1) {

                    if($isAccountLive && $account->is_live == 1)
                        $countAccounts++;

                    if(!$isAccountLive && $account->is_live == 0)
                        $countAccounts++;
                }
            }

            foreach($accounts as $account) {

                if($account->account_number == $accountNumber) {
                    if($account->pivot->confirmed == 1) {
                        if(is_null($member->activated_at)) {
                            $member->activated_at = Carbon::Now();
                            $member->MAC = $mac;
                            $member->location = json_encode(Location::get()->toArray());
                            $member->Save();
                        }

                        return response()->json([
                            'success' => true,
                            'message' => $this->formatExpirationMessage($member),
                            'options' => $this->formatProductOptions($productId, $isEncode)
                        ]);
                    } else {

                        $isAutoConfirm =
                            $member->auto_confirm_new_accounts == 1
                            && (( $isAccountLive && $member->max_live_accounts > $countAccounts)
                            || ( !$isAccountLive && $member->max_demo_accounts > $countAccounts ) );

                        if($isAutoConfirm == false) {
                            return response()->json([
                                'success' => false,
                                'code'=> 101,
                                'message' => 'Account is not activated'
                            ]);
                        }

                        if(is_null($member->activated_at)) {
                                $member->activated_at = Carbon::Now();
                                $member->MAC = $mac;
                                $member->location = json_encode(Location::get()->toArray());
                                $member->Save();
                        }

                        $mpa = MemberProductAccount::where('product_id',$productId)->whereAccountId($account->id)->whereMemberId($member->id)->first();
                        $mpa->confirmed = 1;
                        $mpa->Save();

                        return response()->json([
                            'success' => true,
                            'message' => $this->formatExpirationMessage($member),
                            'options' => $this->formatProductOptions($productId, $isEncode)
                        ]);

                    }
                }
            }

            $account = Account::where( 'account_number', $accountNumber )
                ->first(['id', 'user_id']);

            if ($account == false) {
                $account = new Account;
                $account->account_number = $accountNumber;
                $account->password = $accountNumber;
                $account->broker_server_name = $brokerName;
                $account->user_id = $member->user_id;
                $account->manager_id = $request->user()->id;
                $account->creator_id = $member->user_id;
                $account->is_live = $isAccountLive ? 1 : 0;

                $account->Save();
            }

            $isAutoConfirm =
                $member->auto_confirm_new_accounts == 1
                && (( $isAccountLive && $member->max_live_accounts > $countAccounts)
                || ( !$isAccountLive && $member->max_demo_accounts > $countAccounts ) );
            $mpa = new MemberProductAccount;
            $mpa->product_id = $productId;
            $mpa->account_id = $account->id;
            $mpa->member_id = $member->id;
            $mpa->confirmed = $isAutoConfirm;
            $mpa->Save();

            if($isAutoConfirm) {
                $member->activated_at = Carbon::Now();
                $member->MAC = $mac;
                $member->location = json_encode(Location::get()->toArray());
                $member->Save();

                return response()->json([
                    'success' => true,
                    'message' => $this->formatExpirationMessage($member),
                    'options' => $this->formatProductOptions($productId, $isEncode)
                ]);
            }

            if($isAccountLive) {
                if($member->max_live_accounts <= $countAccounts) {
                    return response()->json([
                        'success' => false,
                        'code'=> 101,
                        'message' => "Max({$member->max_live_accounts}) Live accounts"
                    ]);
                }
            } else {
                if($member->max_demo_accounts <= $countAccounts) {
                    return response()->json([
                        'success' => false,
                        'code'=> 101,
                        'message' => "Max({$member->max_demo_accounts}) Dmmemo accounts"
                    ]);
                }
            }

        } catch (\Exception $e) {
            Log::error($e);
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    private function formatProductOptions($productId, $isEncode) {
        $options = ProductOption::whereProductId($productId)->pluck('val','pkey')->toArray();

        if($isEncode) {
            return base64_encode(json_encode($options));
        }
        return $options;
    }

    private function formatExpirationMessage($member) {
        if($member->expiration_days == -1)
            return 'Lifetime License';

        return 'License valid till '.Carbon::parse($member->expired_at)->toDateString();
    }

}
