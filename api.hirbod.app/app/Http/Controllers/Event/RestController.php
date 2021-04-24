<?php


namespace App\Http\Controllers\Event;


use App\Facades\Rest\Rest;
use App\Helpers\FinanceHelper;
use App\Helpers\SMSHelper;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Account\User;
use App\Http\Controllers\Finance\Transaction;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RestController extends Controller
{

    private $entity;


    public function __construct()
    {
        $this->entity = new Event();

    }

    public function index()
    {
        try {
            $msg='Events Fetched.';
            $data = Event::me()->get();
            if (is_null($data)) {
             return Rest::badRequest();
            }

         return Rest::success($msg,$data);
        } catch (\Exception $e) {
         return Rest::error($e);

        }
    }

    public function show(Request $request,$code)
    {
        try {
            $msg='Event Fetched.';
            $purchase=false;
            $event = Event::where('code', '=', $code)->with(['speakers', 'prices'])->firstOrFail();
            if ($event === null){
                return Rest::notFound();
            }
            $speakers = [];
            foreach ($event->speakers as $speaker) {
                $speakers[] = [
                    'id' => $speaker->id,
                    'name' => $speaker->name,
                    'telegram' => $speaker->telegram,
                    'instagram' => $speaker->instagram,
                    'website' => $speaker->website,
                    'bio' => $speaker->bio,
                    'avatar' => Rest::$SARA . $speaker->avatar
                ];
            }
            $transaction=Event::whereCode($code)->with('transactions')->has('transactions')->first();

            if(!is_null($transaction)){
                $transaction=$transaction->transactions[0];

                if(!is_null(auth('api')->user())){
                    if($transaction->user==auth('api')->user()->id && $transaction->status==1)
                    {
                        $purchase=true;
                    }
                }
            }


            $price = (is_null($event->prices) ? 0 : $event->prices[0]->price);
            $data = [
                'code' => $event->code,
                'location' => $event->location,
                'title' => $event->title,
                'introduction' => $event->introduction,
                'cover' => Rest::$SARA . $event->cover,
                'contributor' => $event->contributon,
                'live' => $event->live === 1 ? true : false,
                'video' => $event->video === 1 ? true : false,
                'dedicated' => $event->dedicated === 1 ? true : false,
                'private' => $event->private === 1 ? true : false,
                'speakers' => $speakers,
                'price' => $price
            ];
            if ($request->bearerToken() && $purchase) {

            }
           return Rest::success($msg,$data);
        } catch (\Exception $e) {
           return Rest::error($e);

        }
    }

    public function register($code, Request $r)
    {
        try {
            $msg='Payment Started.';
            $mobile = $r->input('mobile');
            $name = $r->input('name');
            $captain = null;
            if ($r->has("captain")) {
                $captain = User::where(["username" => $r->input("captain")])->first();
                $captain = $captain->id;
            }
            $rdm = random_int(random_int(1000, 9999), random_int(100000, 999999));
            $user = User::where('mobile', $mobile)->first();
            if ($user === null) {
                $user = User::create([
                    'mobile' => $mobile,
                    'code' => $rdm,
                    'name' => $name,
                    'captain' => $captain,
                    "username" => Str::random(6),
                ]);
                User::where('id', $captain)->increment('team');
            }
            $event = Event::where('code', $code)->with('prices')->first();
            $price = $event->prices[0];
            $transaction = Transaction::create([
                'user' => $user->id,
                'amount' => FinanceHelper::tmnToRls($price->price),
                'description' => 'خرید رویداد ' . $code,
                'authority' => Str::random(),
                'gateway' => 0,
                'transactional_type' => Event::class,
                'transactional_id' => $event->id,
                'status' => 0
            ]);
            $guzzle = new Client([
                'verify' => false
            ]);
            $result = $guzzle->post(config('hirbod.pay.uinvest.url') . 'start', [
                'form_params' => [
                    'gateway' => config('hirbod.pay.uinvest.key'),
                    'amount' => FinanceHelper::tmnToRls($price->price),
                    'callback' => route('api.events.callback'),
                    'mobile' => $mobile,
                    'factorNumber' => $code,
                    'description' => $transaction->description,
                ]
            ]);
            $token = json_decode($result->getBody())->data->token;
            Transaction::where('id', $transaction->id)->update(['authority' => $token]);
            EventRegistration::create([
                'user' => $user->id,
                'event' => $event->id,
                'price' => $price->id,
                'factor' => $token,
                'status' => 0
            ]);
            $payUrl = config('hirbod.pay.uinvest.url') . 'send/' . $token;
            $data = ['url' => $payUrl];
          return Rest::success($msg,$data);
        } catch (\Exception $e) {
            return Rest::error($e);
        }
    }

    public function callback(Request $r)
    {
        try {
            $guzzle = new Client([
                'verify' => false
            ]);
            $token = $r->input('token');
            $res = $guzzle->post(config('hirbod.pay.uinvest.url') . 'verify', [
                'form_params' => [
                    'gateway' => config('hirbod.pay.uinvest.key'),
                    'token' => $token
                ]
            ]);
            $res = json_decode($res->getBody())->data;
            if ($res->status === 1) {
                Transaction::where('authority', $token)->update([
                    'card_number' => $res->cardNumber,
                    'trace_number' => $res->traceNumber,
                    'status' => 1,
                ]);
                Event::where('code', $res->factor)->first();
                EventRegistration::where('factor', $token)->update(['status' => 1]);
                $eventRegistration = EventRegistration::where('factor', $token)->first();
                $user = User::where('id', $eventRegistration->user)->first();
                User::where('id', $user->id)->increment('balance', 500000);
                User::where('id', $user->captain)->increment('balance', 1000000);
                SMSHelper::sendTemplate('sms', $user->mobile, $token, 'hirbod-payment');
                SMSHelper::sendTemplate('sms', '09149677990', $token, 'hirbod-payment');
                SMSHelper::sendTemplate('sms', '09127510860', $token, 'hirbod-payment');
            }
            return redirect('https://hbod.ir/pg/' . $token);
        } catch (\Exception $e) {
           return Rest::error($e);
            return redirect('https://hbod.ir/pg/' . $token);
        }
    }

    public function info($token)
    {
        try {
            $msg='Information Fetched.';
            $transaction = Transaction::where('authority', $token)->first();
            $event = EventRegistration::where('factor', $token)->first();
            $event = Event::where('id', $event->event)->first();
            $user = User::where('id', $transaction->user)->first();
            $data = [
                'amount' => FinanceHelper::rlsToTmn($transaction->amount),
                'mobile' => $user->mobile,
                'description' => $transaction->description,
                'cardNumber' => $transaction->cardNumber,
                'traceNumber' => $transaction->trace_number,
                'status' => $transaction->status,
                'event' => $event->code,
                'username' => $user->username
            ];
            return Rest::success($msg,$data);
        } catch (\Exception $e) {
           return Rest::error($e);
        }
    }

    public function myPurchase()
    {

        try {
            $msg='Events fetched.';
            $events = Event::has('myTransactions')->get();
            $data = (!is_null($events) ? null : $events->makeHidden('id'));
          return Rest::success($msg,$data);
        } catch (\Exception $e) {
            return Rest::error($e);

        }
    }


    public function update(Request $request, $event)
    {

        try {
            $msg='Event Updated.';
            $date = date('Y-m');

            $event = Event::findOrFail($event);

            if ($request->has('title')) {

                $event->update(['title' => $request->input('title')]);
            }
            if ($request->has('from')) {

                $event->update(['from' => $request->input('from')]);
            }
            if ($request->has('till')) {
                $event->update(['till' => $request->input('till')]);
            }

            if ($request->has('location')) {
                $event->update(['location' => $request->input('location')]);
            }
            if ($request->has('introduction')) {
                $event->update(['introduction' => $request->input('introduction')]);
            }
            if ($request->has('live')) {
                $event->update(['live' => $request->input('live')]);
            }
            if ($request->has('video')) {
                $event->update(['video' => $request->input('video')]);
            }
            if ($request->has('address')) {
                $event->update(['address' => $request->input('address')]);
            }
            if ($request->has('contributor')) {
                $event->update(['contributor' => $request->input('contributor')]);
            }

            if($request->has('cover')){

                Storage::delete($event->cover);

                $event->update(["file"=>Storage::disk('liara')->put($date.'/course/cover', $request->file('cover'))]);

            }
            if ($request->has('latitude')) {
                $event->update(['latitude' => $request->input('latitude')]);
            }
            if ($request->has('longitude')) {
                $event->update(['longitude' => $request->input('longitude')]);
            }
            if ($request->has('longitude')) {
                $event->update(['longitude' => $request->input('longitude')]);
            }
            if ($request->has('private')) {
                $event->update(['private' => $request->input('private')]);
            }
            if ($request->has('dedicated')) {
                $event->update(['dedicated' => $request->input('dedicated')]);
            }
            if ($request->has('type')) {
                $event->update(['type' => $request->input('type')]);
            }

            if ($request->has('level')) {
                $event->update(['level' => $request->input('level')]);
            }
          return Rest::success($msg,null);
        } catch (\Exception $e) {
          return Rest::error($e);

        }


    }
}