<?php

namespace App\Http\Controllers\EBook;

use App\Facades\Rest\Rest;
use App\Helpers\Finance\PaymentHelper;
use App\Helpers\FinanceHelper;
use App\Http\Controllers\Account\User;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Finance\Transaction;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RestController extends Controller
{

    private $entity;

    public function __construct()
    {
        $this->entity = new EBook();
    }

    public function index(){

        try {
            $data=[];
            $msg='Ebook fetched.';

            $items=EBook::with('transactions')->get();

            foreach ($items as $key=>$item)
            {
                $price = $item->relation ? $item->prices[0]->price : 0;
                $access=$item->transactions()->where(['user'=>auth('api')->user()->id,"status"=>1])->exists();
                $data[]=[
                    "uuid"=>$item->uuid,
                    "price"=>$price,
                    "username"=> User::find($item->user)->username,
                    "title"=> $item->title,
                    "cover"=> $item->cover,
                    "description"=> $item->description,
                    "introduction"=> $item->introduction,
                    "readers"=> intval($item->readers),
                    "pages"=> intval($item->pages),
                    "isbn"=> $item->isbn,
                    "level"=>$item->level,
                    "status"=> $item->status,
                    "createdAt"=>$item->created_at,
                    "updatedAt"=> $item->updatetd_at
                ];
                if ($access) {
//                $data['file'] = ResponseHelper::$SARA.$ebook->file;
                    $data[$key]['token'] = $item->token;
                }

            }


            return Rest::success($msg, $data);
        }catch(\Exception $e) {
            return Rest::error($e);
        }
    }

    public function show($uuid,Request $request){

        try {

            $ebook=EBook::findUUID($uuid);
            if ($ebook === null){
                return Rest::badRequest();
            }
            $access=$ebook->transactions()->where(['user'=>auth('api')->id(),"status"=>1])->exists();
            $price = $ebook->relation ? $ebook->prices[0]->price : 0;
            $data=[
                "uuid"=>$ebook->uuid,
                "price"=>$price,
                "username"=> User::find($ebook->user)->username,
                "title"=> $ebook->title,
                "cover"=> $ebook->cover,
                "description"=> $ebook->description,
                "introduction"=> $ebook->introduction,
                "readers"=> intval($ebook->readers),
                "pages"=>intval( $ebook->pages),
                "sample"=> $ebook->sample,
                "isbn"=> $ebook->isbn,
                "level"=>$ebook->level,
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
            return dd($e->getMessage());
            return Rest::error($e);
        }
    }


    public function myPurchase(){
        try {
        $data=[];
        $msg='Ebooks fetched.';
            $items=EBook::with('myTransactions','prices')->has('myTransactions')->get();

            foreach ($items as $key=>$item)
            {
                $price = count($item->prices) > 0 ? $item->prices[0]->price : 0;
                $data[]=[
                    "uuid"=>$item->uuid,
                    "price"=>$price,
                    "username"=> User::find($item->user)->username,
                    "title"=> $item->title,
                    "cover"=> $item->cover,
                    "description"=> $item->description,
                    "introduction"=> $item->introduction,
                    "readers"=> intval($item->readers),
                    "pages"=> intval($item->pages),
                    "isbn"=> $item->isbn,
                    "level"=>$item->level,
                    "status"=> $item->status,
                    "createdAt"=>$item->created_at,
                    "updatedAt"=> $item->updatetd_at,
                   'token' => $item->token
                ];

            }
            return Rest::success($msg, $data);
        }catch(\Exception $e){
            return Rest::error($e);
        }
    }

    public function myIndex(){

        try {
            $data=[];
            $msg='Ebook fetched.';

             $items=EBook::me()->with('prices')->get();

            foreach ($items as $key=>$item)
            {
                $price = $item->relation ? $item->prices[0]->price : 0;
                $data[]=[
                    "uuid"=>$item->uuid,
                    "price"=>$price,
                    "username"=> User::find($item->user)->username,
                    "title"=> $item->title,
                    "cover"=> $item->cover,
                    "description"=> $item->description,
                    "introduction"=> $item->introduction,
                    "readers"=> intval($item->readers),
                    "pages"=> intval($item->pages),
                    "isbn"=> $item->isbn,
                    "level"=>$item->level,
                    "status"=> $item->status,
                    "token"=> $item->token,
                    "createdAt"=>$item->created_at,
                    "updatedAt"=> $item->updatetd_at
                ];


            }


            return Rest::success($msg, $data);
        }catch(\Exception $e) {
//            return Rest::error($e);
            return dd($e->getMessage());
        }
    }

    public function myShow($uuid,Request $request){

        try {

            $ebook=EBook::me()->with('prices')->where('uuid', '=', $uuid)->firstOrFail();
            $price = $ebook->relation ? $ebook->prices[0]->price : 0;
            $data=[
                "uuid"=>$ebook->uuid,
                "price"=>$price,
                "username"=> User::find($ebook->user)->username,
                "title"=> $ebook->title,
                "cover"=> $ebook->cover,
                "description"=> $ebook->description,
                "introduction"=> $ebook->introduction,
                "readers"=> intval($ebook->readers),
                "pages"=>intval( $ebook->pages),
                "sample"=> $ebook->sample,
                "isbn"=> $ebook->isbn,
                "level"=>$ebook->level,
                "status"=> $ebook->status,
                "token"=> $ebook->token,
                "createdAt"=>$ebook->created_at,
                "updatedAt"=> $ebook->updatetd_at
            ];
            return Rest::success('Ebook fetched.', $data);
        }catch(\Exception $e){
//            return Rest::error($e);
            return dd($e->getMessage());


        }
    }


    public function publishers(){
        try {
            $msg='Publishers fetched.';
            $data=[];

            $data=Publisher::pluck('name');

            return Rest::success($msg, $data);
        }catch (\Exception $exception){
            return Rest::error($exception);
        }

    }
    public function writers(){
        try {
            $msg='Writers fetched.';
            $data=[];

            $data=Writer::pluck('name');

            return Rest::success($msg, $data);
        }catch (\Exception $exception){
            return Rest::error($exception);
        }

    }
    public function titles(){
        try {
            $msg='Titles fetched.';
            $data=[];

            $data=EBook::latest()->where('status','1')->pluck('title');

            return Rest::success($msg, $data);
        }catch (\Exception $exception){
            return Rest::error($exception);
        }

    }

    public function categories(){
        try {
            $msg='Categories fetched.';
            $data=[];

            $categories=Category::latest()->get();

            foreach ($categories as $item)
            {
                $data[]=[
                    "uuid"=>$item->uuid,
                    "title"=> $item->title,
                    "parent"=> $item->parent ,
                    "name"=> $item->name,
                    "color"=> $item->color,
                    "photo"=> $item->photo,
                    "type"=> $item->type,
                    "createdAt"=> $item->created_at,
                ];
            }

            return Rest::success($msg, $data);
        }catch (\Exception $exception){
            return Rest::error($exception);
        }

    }

    public function tags(){
        try {
            $msg='Tags fetched.';
            $data=[];

            $categories=Tag::latest()->get();

            foreach ($categories as $item)
            {
                $data[]=[
                    "uuid"=>$item->uuid,
                    "name"=> $item->name,
                    "color"=> $item->color,
                    "photo"=> $item->photo,
                    "createdAt"=> $item->created_at,
                ];
            }

            return Rest::success($msg, $data);
        }catch (\Exception $exception){
            return Rest::error($exception);
        }

    }

    public function purchase($uuid){
        try{
            $ebook=EBook::where("uuid","=",$uuid)->with(['prices'])->first();
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
            $payment = $payment->payRest($transaction->id, 'payment.callback');
            return Rest::success('Payment Started.', ['url' => $payment]);
        }catch (\Exception $e){
            return Rest::error($e);
        }
    }







}
