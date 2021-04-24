<?php


namespace App\Http\Controllers\EBook;


use App\Enums\Comment\CommentStatus;
use App\Enums\Finance\Transaction\Status;
use App\Enums\Like\LikeStatus;
use App\Facades\HResponse\HResponse;
use App\Facades\Rest\Rest;
use App\Helpers\Finance\PaymentHelper;
use App\Helpers\FinanceHelper;
use App\Http\Controllers\Account\User;
use App\Http\Controllers\Finance\Transaction;
use App\Http\Controllers\Podcast\Podcast;
use App\Models\Category;
use App\Models\Like;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Controller extends \App\Http\Controllers\Controller
{

    public function index(Request $r){
        try {
            $msg= 'EBooks Fetched.';
            $ebooks = EBook::latest()->with(['prices','tags','categories'])->get();
            if ($r->has('category')){
                $category = Category::findUUID($r->input('category'));
                if ($category != null){
                    $ebooks = $category->ebooks;
                }
            }
            return Rest::success($msg,HResponse::ebooks($ebooks));
        } catch (\Exception $exception) {
            return Rest::error($exception);
        }
    }

    public function show($uuid,Request $request){
        try {
            $ebook=EBook::where('uuid', $uuid)->with(['categories','tags','writers','publishers','likes','visits','comments','comments.replies.user','comments.likes','comments.user'])->first();

            if ($ebook === null){
                return Rest::badRequest();
            }
            if (\auth('api')->check()) {
                $liked = $ebook->likes()->whereUser(\auth('api')->id())->first() ? true : false;
            } else {
                $liked = false;
            }
            $access=$ebook->transactions()->where(['user'=>auth('api')->id(),"status"=>1])->exists();
            $visits = $this->visit($uuid, $request->userAgent());
            $price = $ebook->relation ? $ebook->prices[0]->price : 0;

            $transactions = Transaction::whereUser(\auth('api')->id())
                ->where('transactional_type' , get_class($ebook))
                ->where('transactional_id' , $ebook->id)
                ->whereStatus('1')
                ->first();

            !empty($transactions) ? $is_buy = true : $is_buy = false;

            if ($ebook->categories()->count() > 0) {
                $related = Category::where(['uuid' => $ebook->categories()->first()->uuid])->latest()->with(['courses'])->first();
            } else {
                $related = [];
            }

            $is_owner = auth('api')->id() == $ebook->user ? 'true' : 'false';

            $data=[
                "uuid"=>$ebook->uuid,
                "price"=>$price,
                "username"=> User::find($ebook->user)->username,
                "title"=> $ebook->title,
                "cover"=> Rest::tempUrl($ebook->cover),
                "description"=> $ebook->description,
                "introduction"=> $ebook->introduction,
                "readers"=> intval($ebook->readers),
                "pages"=>intval( $ebook->pages),
                "sample"=> Rest::tempUrl($ebook->sample),
                "isbn"=> $ebook->isbn,
                "level" => $ebook->level,
                "views" => $visits,
                "likes" => $ebook->likes()->whereStatus(LikeStatus::LIKE)->get()->count(),
                'publisher' => HResponse::publishers($ebook->publishers),
                'rate' => 4.2,
                'category' => HResponse::categories($ebook->categories),
                'tags' => HResponse::tags($ebook->tags),
                'writer' => HResponse::writers($ebook->writers),
                'liked' => $liked,
                'purchase' => $is_buy,
                'file' => $is_buy ? Rest::tempUrl($ebook->file) : null,
//                'file' => $is_buy ? Storage::temporaryUrl($ebook->file,now()->addHours(3)) : null,
                'is_owner' => $is_owner,
                'related' => !empty($related) ? HResponse::ebooksRelated($related , $ebook->uuid) : [],
                'comments' => HResponse::comments($ebook->comments()->where('parent_id' , 0)->where('status' , CommentStatus::APPROVED)->latest()->get()),
                "status"=> $ebook->status,
                "createdAt"=>$ebook->created_at,
                "updatedAt"=> $ebook->updatetd_at
            ];
            if ($access) {
//                $data['file'] = ResponseHelper::$SARA.$ebook->file;
                $data['token'] = $ebook->token;
            }
            return Rest::success('Ebook fetched.', $data);
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
                'pricable_type' => Ebook::class,
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
            $course = EBook::where(['uuid' => $uuid])->with('likes')->first();
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
                    'likable_type' => EBook::class,
                    'likable_id' => $course['id'],
                ]);
                $count = $count+1;
            }
            else {
                foreach (EBook::where(['uuid' => $uuid])->get() as $item) {
                    $item->likes()->whereUser(auth('api')->id())->delete();
                }
                --$count;
            }
            return Rest::success('Success', ['likes' => $count]);
        }catch (\Exception $e){
            return Rest::error($e);
        }
    }

    private function visit($uuid, $userAgent){
        try{
            $ebook = EBook::where(['uuid' => $uuid])->with('visits')->first();
            if ($ebook === null){
                return Rest::notFound();
            }
            $visited = false;
            $count = count($ebook['visits']);
            foreach ($ebook['visits'] as $visit) {
                if(intval($visit->user) === intval(auth('api')->id())){
                    $visited = true;
                }
            }
            if (!$visited){
                Visit::create([
                    'user' => auth('api')->id(),
                    'current' => $ebook->title,
                    'agent' => $userAgent,
                    'visitable_type' => Ebook::class,
                    'visitable_id' => $ebook->id
                ]);
                $count = $count+1;
            }
            return $count;
        }catch (\Exception $e){
            return Rest::error($e);
        }
    }

}