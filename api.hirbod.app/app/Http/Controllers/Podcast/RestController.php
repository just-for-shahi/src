<?php

namespace App\Http\Controllers\Podcast;

use App\Facades\Rest\Rest;
use App\Http\Controllers\Account\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RestController extends Controller
{
    private $entity;

    public function __construct()
    {
        $this->entity = new Podcast();

    }

    public function myPurchase(){

        try {
            $msg= 'Podcasts fetched.';
            $podcasts=Podcast::has('myTransactions')->get();
            $data=(!is_null($podcasts) ? null:$podcasts->makeHidden('id'));
          return Rest::success($msg,$data);
        }catch(\Exception $e){
            return Rest::error($e);

        }


    }

    public function store(Request $request){

        try {
            $msg='Podcast Store.';
            $date = date('Y-m');
            $this->entity->code=Str::random(6);
            $this->entity->user=auth()->user()->id;
            $this->entity->cover=Storage::disk('liara')->put($date.'/podcasts', $request->file('cover'));
            $this->entity->logo=Storage::disk('liara')->put($date.'/podcasts', $request->file('logo'));
            $this->entity->name=$request->input('name');
            $this->entity->website=$request->input('website');
            $this->entity->save();

           return Rest::success($msg,null);
        }catch(\Exception $e){
            return Rest::error($e);

        }


    }
}
