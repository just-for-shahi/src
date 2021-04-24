<?php


namespace App\Http\Controllers\Account;


use App\Facades\Rest\Rest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlueTickController extends Controller
{

    private $obj;

    public function __construct()
    {
        $this->obj = new BlueTick();
    }

    public function store(Request $r){
        try{
            $this->obj->uuid = Str::uuid();
            $this->obj->user = auth('api')->id();
            $this->obj->passport = $r->file('passport')->store('blue-ticks'.date('Y-m'));
            $this->obj->purpose = $r->input('purpose');
            $this->obj->youtube = $r->input('youtube');
            $this->obj->twitter = $r->input('twitter');
            $this->obj->instagram = $r->input('instagram');
            $this->obj->save();
            return Rest::success('Your request received.', null);
        }catch (\Exception $e){
            return Rest::error($e);
        }
    }

}