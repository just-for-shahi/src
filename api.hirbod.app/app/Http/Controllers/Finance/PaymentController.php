<?php


namespace App\Http\Controllers\Finance;


use App\Facades\Rest\Rest;
use App\Helpers\Finance\PaymentHelper;
use App\Helpers\Finance\PlusHelper;
use App\Helpers\FinanceHelper;
//use App\Helpers\SMSHelper;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Account\User;
use App\Http\Controllers\Course\Course;
use App\Http\Controllers\EBook\EBook;
use App\Http\Controllers\Event\Event;
use App\Http\Controllers\Podcast\Episode;
use App\Http\Controllers\Podcast\Podcast;
//use App\Jobs\SendSMS;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PaymentController extends Controller
{

    public function ebook($code){
        $ebook=EBook::where("code","=",$code)->with(['prices'])->first();
        $amount = $ebook->prices[0]->price;
        $transaction = Transaction::create([
            'user' => auth()->id(),
            'amount' => FinanceHelper::tmnToRls($amount),
            'description' => ' خرید کتاب به مبلغ '.$amount,
            'authority' => Str::random(),
            'pricable_type' => EBook::class,
            'pricable_id' => auth()->id()
        ]);
        $payment = new PaymentHelper();
        $payment = $payment->payRest($transaction->id, 'wallet.callback');
        $data = ['url' => $payment];
        return Rest::success('Payment Started.', $data);
    }
    public function podcast($code){

        $podcast=Podcast::where("code","=",$code)->with(['prices'])->first();
        $amount = $podcast->prices[0]->price;
        $transaction = Transaction::create([
            'user' => auth()->id(),
            'amount' => FinanceHelper::tmnToRls($amount),
            'description' => ' خرید پادکست به مبلغ '.$amount,
            'authority' => Str::random(),
            'pricable_type' => Podcast::class,
            'pricable_id' => auth()->id()
        ]);
        $payment = new PaymentHelper();
        $payment = $payment->payRest($transaction->id, 'wallet.callback');
        $data = ['url' => $payment];
        return Rest::success('Payment Started.', $data);
    }
    public function episode($id){

        $episode=Episode::where("id","=",$id)->with(['prices'])->first();
        $amount = $episode->prices[0]->price;
        $transaction = Transaction::create([
            'user' => auth()->id(),
            'amount' => FinanceHelper::tmnToRls($amount),
            'description' => ' خرید دوره به مبلغ '.$amount,
            'authority' => Str::random(),
            'pricable_type' => Episode::class,
            'pricable_id' => auth()->id()
        ]);
        $payment = new PaymentHelper();
        $payment = $payment->payRest($transaction->id, 'wallet.callback');
        $data = ['url' => $payment];
        return Rest::success('Payment Started.', $data);
    }

    public function plus(Request $r){
        try{
            $period = $r->input('period');
            $amount = FinanceHelper::tmnToRls(PlusHelper::prices($period));
            $transaction = Transaction::create([
                'user' => auth()->id(),
                'amount' => $amount,
                'description' => 'خرید پلاس '.$amount,
                'authority' => Str::random(),
                'pricable_type' => 'plus',
                'pricable_id' => auth()->id()
            ]);
            $payment = new PaymentHelper();
            $payment = $payment->payRest($transaction->id, 'wallet.callback');
            $data = ['url' => $payment];
            return Rest::success('Payment Started.', $data);
        }catch (\Exception $e){
            return Rest::error($e);
        }
    }

    public function callback(Request $r){
        try{
            $authority = $r->input('Authority');
            $transaction = Transaction::where('authority', $authority)->first();
            $guzzle = new Client([
                'verify' => false
            ]);
            $res = $guzzle->post( 'https://api.zarinpal.com/pg/v4/payment/verify.json', [
                'form_params' => [
                    'merchant_id' => config('hirbod.zp.gateway'),
                    'amount' => $transaction->amount*10,
                    'authority' => $authority
                ]
            ]);
            $res = json_decode($res->getBody())->data;
            if ($res->code === 100){
                Transaction::where('authority', $authority)->update([
                    'card_number' => "$res->card_pan",
                    'trace_number' =>"$res->ref_id",
                    'status' => 1,
                ]);
                switch ($transaction->transactional_type){
                    case EBook::class:
                        // TODO: Complete this section for ebooks;
                        break;
                    case Podcast::class:
                        // TODO podcast
                        break;
                    case Course::class:
                        // TODO course
                        break;
                    case Event::class:
                        // TODO events
                        break;
                    case 'plus':
                        $p = str_replace('خرید پلاس ','',$transaction->description);
                        $duration = PlusHelper::durations($p);
                        User::where('id', $transaction->user)->update(['plus' => $duration]);
                        break;
                    case User::class:
                    default:
                        User::where('id', $transaction->user)->increment('balance', $transaction->amount);
                        break;
                }
//                SMSHelper::sendTemplate('sms', $user->mobile, $authority, 'hirbod-payment');
//                SMSHelper::sendTemplate('sms', '09149677990', $authority, 'hirbod-payment');
//                SMSHelper::sendTemplate('sms', '09127510860', $authority, 'hirbod-payment');
            }
//            return Rest::success("success",$res);
        }catch (\Exception $e){
            Bugsnag::notifyException($e);
        }
        return redirect('https://hirbod.ac/pg/'.$authority);
    }

}