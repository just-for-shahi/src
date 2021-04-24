<?php


namespace App\Http\Controllers\Course;


use App\Enums\Comment\CommentStatus;
use App\Enums\Finance\Transaction\Status;
use App\Enums\Like\LikeStatus;
use App\Facades\HResponse\HResponse;
use App\Facades\Rest\Rest;
use App\Helpers\Finance\PaymentHelper;
use App\Helpers\FinanceHelper;
use App\Http\Controllers\Account\User;
use App\Http\Controllers\Finance\Transaction;
use App\Http\Controllers\Podcast\Episode;
use App\Models\Category;
use App\Models\Like;
use App\Models\Play;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Controller extends \App\Http\Controllers\Controller
{

    public function index(){
        try {
            $msg= 'Courses Fetched.';
            $courses = Course::latest()->with(['prices','lectures','tags','categories'])->get();
            return Rest::success($msg,HResponse::courses($courses));
        } catch (\Exception $exception) {
            return Rest::error($exception);
        }
    }

    public function show($uuid, Request $r){
        try {
            $msg='Course fetched.';
            $purchase = true;
            $course = Course::where('uuid', '=', $uuid)->with(['prices','lectures','tags','categories','likes','visits','comments','comments.replies.user','comments.likes','comments.user'])->firstOrFail();
            if ($course === null){
                return Rest::notFound();
            }
            if (\auth('api')->check()) {
                $liked = $course->likes()->whereUser(\auth('api')->id())->first() ? true : false;
            } else {
                $liked = false;
            }
            $visit = $this->visit($uuid, $r->userAgent());

            $price = 0;
            if(count($course->prices)>0){
                $price = $course->prices()->latest()->first()->price;
            }

            $transactions = Transaction::whereUser(\auth('api')->id())
                ->where('transactional_type' , get_class($course))
                ->where('transactional_id' , $course->id)
                ->whereStatus('1')
                ->first();

            !empty($transactions) ? $is_buy = true : $is_buy = false;

            if ($course->categories()->count() > 0) {
                $related = Category::where(['uuid' => $course->categories()->first()->uuid])->latest()->with(['courses'])->first();
            } else {
                $related = [];
            }

            $is_owner = auth('api')->id() == $course->user ? 'true' : 'false';

            $data=[
                'uuid' => $course->uuid,
                'title' => $course->title,
                'photo' => Rest::tempUrl($course->cover),
                'description' => $course->description,
                'introduction' => $course->introduction,
                'duration' => $course->duration,
                "author"=> User::find($course->user)->username,
                "price"=>$price,
                'level' => $course->level,
                "lectures" => HResponse::lectures($course->lectures, $is_buy),
                "categories" => HResponse::categories($course->categories),
                "tags" => HResponse::tags($course->tags),
                "views" => $visit,
                "likes" => $course->likes()->whereStatus(LikeStatus::LIKE)->get()->count(),
                "rate" => 4.1,
                'students' => $course->students,
                'liked' => $liked,
                'purchase' => $is_buy,
                'is_owner' => $is_owner,
                'related' => !empty($related) ? HResponse::coursesRelated($related , false , $course->uuid) : [],
                'comments' => HResponse::comments($course->comments()->where('parent_id' , 0)->where('status' , CommentStatus::APPROVED)->latest()->get()),
                "createdAt"=> $course->jCreated,
                "updatedAt"=> $course->jUpdated,

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
            $course=Course::where("uuid","=",$uuid)->with(['prices'])->first();
            $amount = $course->prices[0]->price;
            $transaction = Transaction::create([
                'account' => $usr->id,
                'amount' => FinanceHelper::tmnToRls($amount),
                'description' => ' خرید دوره به مبلغ '.$amount,
                'authority' => Str::random(),
                'pricable_type' => Course::class,
                'pricable_id' => $course['id']
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
            $course = Course::where(['uuid' => $uuid])->with('likes')->first();
            if ($course === null){
                return Rest::notFound();
            }
            $liked = false;
            $count = count($course['likes']);
            foreach ($course['likes'] as $like) {
                if(intval($like->user) === intval(auth('api')->id())){
                    $liked = true;
                }
            }
            if (!$liked){
                Like::create([
                    'user' => auth('api')->id(),
                    'likable_type' => Course::class,
                    'likable_id' => $course['id'],
                ]);
                $count = $count+1;
            }
            else {
                foreach (Course::where(['uuid' => $uuid])->get() as $item) {
                    $item->likes()->whereUser(auth('api')->id())->delete();
                }
                --$count;
            }
            return Rest::success('Success', ['likes' => $count]);
        }catch (\Exception $e){
            return Rest::error($e);
        }
    }

    public function play(Request $request , $uuid){
        try{
            $episode = Episode::where(['uuid' => $uuid])->first();
            $episode->increment('plays', 1);
            $user = \auth('api')->user();

            if ($episode === null){
                return Rest::notFound();
            }

            Play::create([
                'user' => $user->id,
                'user_agent' => $request->userAgent(),
                'playable_type' => get_class($episode),
                'playable_id' => $episode->id,
                'times' => '0',
                'last_seen' => '0'
            ]);

            return Rest::success('Success', null);
        }catch (\Exception $e){
            return Rest::error($e);
        }
    }

    private function visit($uuid, $userAgent){
        try{
            $course = Course::where(['uuid' => $uuid])->with('visits')->first();
            if ($course === null){
                return Rest::notFound();
            }
            $visited = false;
            $count = count($course['visits']);
            foreach ($course['visits'] as $visit) {
                if(intval($visit->user) === intval(auth('api')->id())){
                    $visited = true;
                }
            }
            if (!$visited){
                Visit::create([
                    'user' => auth('api')->id(),
                    'current' => $course->title,
                    'agent' => $userAgent,
                    'visitable_type' => Course::class,
                    'visitable_id' => $course->id
                ]);
                $count = $count+1;
            }
            return $count;
        }catch (\Exception $e){
            return Rest::error($e);
        }
    }
}