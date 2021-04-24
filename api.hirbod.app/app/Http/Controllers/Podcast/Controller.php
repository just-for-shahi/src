<?php


namespace App\Http\Controllers\Podcast;


use App\Enums\Comment\CommentStatus;
use App\Enums\Finance\Transaction\Status;
use App\Enums\Like\LikeStatus;
use App\Facades\HResponse\HResponse;
use App\Facades\Rest\Rest;
use App\Helpers\Finance\PaymentHelper;
use App\Helpers\FinanceHelper;
use App\Http\Controllers\Account\User;
use App\Http\Controllers\Finance\Transaction;
use App\Models\Category;
use App\Models\Like;
use App\Models\Play;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Controller extends \App\Http\Controllers\Controller
{

    public function index(){
        try {
            $msg= 'Podcasts Fetched.';
            $podcasts = Podcast::latest()->with(['prices','episodes','tags','categories'])->get();
            return Rest::success($msg,HResponse::podcasts($podcasts));
        } catch (\Exception $exception) {
            return Rest::error($exception);
        }
    }

    public function show($uuid, Request $r){
        try {
            $msg='Podcast fetched.';
            $purchase=true;
            $podcast=Podcast::where('uuid', '=', $uuid)->with(['prices','episodes','tags','categories','likes','visits','comments','comments.replies.user','comments.likes','comments.user'])->firstOrFail();

            if ($podcast === null){
                return Rest::notFound();
            }
            if (\auth('api')->check()) {
                $liked = $podcast->likes()->whereUser(\auth('api')->id())->first() ? true : false;
            } else {
                $liked = false;
            }
            $visits = $this->visit($uuid, $r->userAgent());
            $price = 0;
            if(count($podcast->prices)>0){
                $price = $podcast->prices[0]->price;
                if ($price>0){
                    $purchase = false;
                }
            }

            $transactions = Transaction::whereUser(\auth('api')->id())
                ->where('transactional_type' , get_class($podcast))
                ->where('transactional_id' , $podcast->id)
                ->whereStatus('1')
                ->first();

            !empty($transactions) ? $is_buy = true : $is_buy = false;

            if ($podcast->categories()->count() > 0) {
                $related = Category::where(['uuid' => $podcast->categories()->first()->uuid])->latest()->with(['podcasts'])->first();
            } else {
                $related = [];
            }

            $is_owner = auth('api')->id() == $podcast->user ? 'true' : 'false';

            $data=[
                'uuid' => $podcast->uuid,
                'title' => $podcast->title,
                'logo' => Rest::tempUrl($podcast->logo),
                'photo' => Rest::tempUrl($podcast->cover),
                'description' => $podcast->description,
                "price"=>$price,
                "username"=> User::find($podcast->user)->username,
                "website"=> $podcast->website,
                "episodes" => HResponse::episodes($podcast->episodes, $is_buy),
                "categories" => HResponse::categories($podcast->categories),
                "tags" => HResponse::tags($podcast->tags),
                "views" => $visits,
                "likes" => $podcast->likes()->whereStatus(LikeStatus::LIKE)->get()->count(),
                "narrator" => "Milad Sh",
                "listeners" => $visits,
                "length" => random_int(231,21321),
                "rate" => 4.1,
                "publisher" => User::find($podcast->user)->name,
                'liked' => $liked,
                'purchase' => $is_buy,
                'is_owner' => $is_owner,
                'related' => HResponse::podcastsRelated($related , $podcast->uuid),
                'comments' => HResponse::comments($podcast->comments()->where('parent_id' , 0)->where('status' , CommentStatus::APPROVED)->with(['replies.user','likes','user'])->latest()->get()),
                "createdAt"=> $podcast->jCreated,
                "updatedAt"=> $podcast->jUpdated,

            ];
            if ($r->bearerToken() && $purchase && $r->header('secret') === config('hirbod.secret')) {
                $data['secret'] = true;
            }
            return Rest::success($msg,$data);
        }catch(\Exception $e){
            return Rest::error($e);
        }
    }

    public function purchase($uuid){
        try{
            $usr = auth('api')->user();
            $podcast=Podcast::where("uuid","=",$uuid)->with(['prices'])->first();
            $amount = $podcast->prices[0]->price;
            $transaction = Transaction::create([
                'account' => $usr->id,
                'amount' => FinanceHelper::tmnToRls($amount),
                'description' => ' خرید پادکست به مبلغ '.$amount,
                'authority' => Str::random(),
                'pricable_type' => Podcast::class,
                'pricable_id' => $podcast['id']
            ]);
            $payment = new PaymentHelper();
            $payment = $payment->payRest($transaction->id, 'callback');
            $data = ['url' => $payment];
            return Rest::success('Payment Started.', $data);
        }catch (\Exception $e){
            return Rest::error($e);
        }
    }

    public function callback(Request $r){
        try {
            $Authority = $r->input('Authority');
            $transaction = Transaction::where('authority', $Authority)->first();
            if ($transaction != null) {
                $data = array('MerchantID' => config('hirbod.zp.gateway'), 'Authority' => $Authority, 'Amount' => $transaction->amount);
                $jsonData = json_encode($data);
                $ch = curl_init('https://sandbox.zarinpal.com/pg/rest/WebGate/PaymentVerification.json');
                curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v1');
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($jsonData)
                ));
                $result = curl_exec($ch);
                $err = curl_error($ch);
                curl_close($ch);
                $result = json_decode($result, true);
                return $result;
                if ($err) {
                    echo "cURL Error #:" . $err;
                } else {
                    if ($result['Status'] == 100) {
                        Transaction::where('authority', $token)->update([
                            'card_number' => $result['CardNumber'],
                            'trace_number' => $result['RefID'],
                            'status' => Status::PAID
                        ]);
                        return true;
                    } else {
                        echo 'Transation failed. Status:' . $result['Status'];
                        return false;
                    }
                }
            }
        }catch (\Exception $e){
            return dd($e);
        }
    }

    public function like($uuid){
        try{
            $podcast = Podcast::where(['uuid' => $uuid])->with('likes')->first();
            if ($podcast === null){
                return Rest::notFound();
            }
            $liked = false;
            $count = count($podcast['likes']);
            foreach ($podcast['likes'] as $like) {
                if(intval($like->user) === intval(auth('api')->id())){
                    $liked = true;
                }
            }
            if (!$liked){
                Like::create([
                    'user' => auth('api')->id(),
                    'likable_type' => Podcast::class,
                    'likable_id' => $podcast['id'],
                ]);
                $count = $count + 1;
            }
            else {
                foreach (Podcast::where(['uuid' => $uuid])->get() as $item) {
                    $item->likes()->whereUser(auth('api')->id())->delete();
                }
                --$count;
            }
            return Rest::success('Success', ['likes' => $count]);
        }catch (\Exception $e){
            return Rest::error($e);
        }
    }

    public function play($uuid){
        try{
            $episode = Episode::where(['uuid' => $uuid])->increment('plays', 1);
            // @TODO: Add play model to record data
            if ($episode === null){
                return Rest::notFound();
            }
            return Rest::success('Success', null);
        }catch (\Exception $e){
            return Rest::error($e);
        }
    }

    private function visit($uuid, $userAgent){
        try{
            $podcast = Podcast::where(['uuid' => $uuid])->with('visits')->first();
            if ($podcast === null){
                return Rest::notFound();
            }
            $visited = false;
            $count = count($podcast['visits']);
            foreach ($podcast['visits'] as $visit) {
                if(intval($visit->user) === intval(auth('api')->id())){
                    $visited = true;
                }
            }
            if (!$visited){
                Visit::create([
                    'user' => auth('api')->id(),
                    'current' => $podcast->title,
                    'agent' => $userAgent,
                    'visitable_type' => Podcast::class,
                    'visitable_id' => $podcast->id
                ]);
                $count = $count+1;
            }
            return $count;
        }catch (\Exception $e){
            return Rest::error($e);
        }
    }
}