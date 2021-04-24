<?php


namespace App\Http\Controllers\Support;


use App\Facades\Rest\Rest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CallController extends Controller
{

    private $entity;

    public function __construct()
    {
        $this->entity = new CallRequest();
    }

    public function store(Request $r){
        try{
            $this->entity->name = $r->input('name');
            $this->entity->phone = $r->input('phone');
            $this->entity->save();
            return Rest::success('CallRequest Received', null);
        }catch (\Exception $e){
            return Rest::error($e);
        }
    }
    public function destroy($call){
        try{
            $this->entity->findUUID($call)->delete();
            return Rest::success('CallRequest Destroyed', null);
        }catch (\Exception $e){
            return Rest::error($e);
        }
    }

}