<?php


namespace App\Http\Controllers\Support;


use App\Facades\Rest\Rest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ComplaintController extends Controller
{


    private $entity;

    public function __construct()
    {

        $this->entity = new Complaint();
    }

    public function index(){
        try{
            $msg='Complaints Fetched.';
            $data=[];
            $complaints=Complaint::latest()->get();
            foreach ($complaints as $item)
            {
                $data[]=[
                    "uuid"=>$item->uuid,
                    "name"=>$item->name,
                    "phone"=> $item->phone,
                    "content"=>$item->content,
                    "status"=> intval($item->status),
                    "createdAt"=>$item->jCreated,
                    "updatedAt"=> $item->jUpdated
                ];
            }
          return Rest::success($msg,$data);
        }catch (\Exception $e){
           return Rest::error($e);
        }
    }

    public function store(Request $r){
        try{
            $msg='Complaint Registered.';
            $this->entity->name = $r->input('name');
            $this->entity->phone = $r->input('phone');
            $this->entity->content = $r->input('content');
            $this->entity->save();
           return Rest::success($msg,null);
        }catch (\Exception $e){
           return Rest::error($e);
        }
    }


}