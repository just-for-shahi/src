<?php


namespace App\Http\Controllers\Finance;


use App\Enums\Finance\Transaction\Status;
use App\Facades\Rest\Rest;
use App\Helpers\Finance\PaymentHelper;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Course\Course;
use App\Http\Controllers\EBook\EBook;
use App\Http\Controllers\Event\Event;
use App\Http\Controllers\Podcast\Podcast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PurchaseController extends Controller
{

    public function purchase(Request $r){
        try{
            $type = $r->input('type');
            $uuid = $r->input('uuid');
            $fromwallet = $r->fromwallet;
            $usr = auth('api')->user();
            switch (intval($type)){
                default:
                case 0:
                    $model = Course::where('uuid', $uuid)->with(['prices'])->first();
                    $desc = 'خرید دوره';
                    break;
                case 1:
                    $model = EBook::where("uuid","=",$uuid)->with(['prices'])->first();
                    $desc = 'خرید کتاب';
                    break;
                case 2:
                    $model = Podcast::where("uuid","=",$uuid)->with(['prices'])->first();
                    $desc = 'خرید پادکست';
                    break;
                case 3:
                    $model = Event::where('uuid', $uuid)->with(['prices'])->first();
                    $desc = 'خرید رویداد';
                    break;
            }
            if (!$model) {
                return Rest::notFound();
            }
            $buyed_before = Transaction::whereUser($usr->id)
                ->where('transactional_type' , get_class($model))
                ->where('transactional_id' , $model->id)
                ->where('status' , Status::PAID)
                ->first();
            if ($buyed_before) {
                return Rest::badRequest('Paid Before' , ['url' => 'free']);
            }
            if ($model->prices->count() > 0 && $model->prices()->latest()->first()->price != 0){
                $amount = $model->prices()->latest()->first()->price;
                if ($fromwallet == 1 && $usr->balance >= $amount) {
                    $balance = $usr->balance - $amount;
                    $usr->update([
                        'balance' =>  $balance
                    ]);
                    $transaction = Transaction::create([
                        'user' => $usr['id'],
                        'amount' => $amount,
                        'description' => "از کیف پول کم شد{$desc} با قیمت {$amount}",
                        'authority' => Str::random(),
                        'transactional_type' => get_class($model),
                        'transactional_id' => $model['id'],
                        'status' => Status::PAID
                    ]);
                    return Rest::success('Payment Paid From Wallet', ['url' => 'free']);
                }
                $transaction = Transaction::create([
                    'user' => $usr['id'],
                    'amount' => $amount,
                    'description' => "{$desc} با قیمت {$amount}",
                    'authority' => Str::random(),
                    'transactional_type' => get_class($model),
                    'transactional_id' => $model['id']
                ]);
                $payment = new PaymentHelper();
                $payment = $payment->payRest($transaction['uuid']);
                $data = ['url' => $payment];
                return Rest::success('Payment Started.', $data);
            }
            $amount = 0;
            Transaction::create([
                'user' => $usr['id'],
                'amount' => $amount,
                'description' => "{$desc} به صورت رایگان ",
                'authority' => Str::random(),
                'status' => Status::PAID,
                'transactional_type' => get_class($model),
                'transactional_id' => $model['id']
            ]);
//            if (get_class($model) === 'App\Http\Controllers\EBook\EBook') {
//                if ($model->file === null) {
//                    return Rest::notFound();
//                }
//                return Rest::success('Purchase Successful', ['url' => Rest::tempUrl($model->file)]);
                //return Rest::success('Purchase Successful', ['url' => Storage::temporaryUrl($model->file , now()->addHours(3))]);
//            } else {
                return Rest::success('Purchase Successful', ['url' => 'free']);
//            }

        }catch (\Exception $e){
            return Rest::error($e);
        }
    }

}