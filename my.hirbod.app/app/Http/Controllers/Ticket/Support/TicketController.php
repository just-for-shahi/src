<?php

namespace App\Http\Controllers\Support;

use App\Facades\HResponse\HResponse;
use App\Facades\Rest\Rest;
use App\Helpers\Support\TicketHelper;
use App\Http\Controllers\Account\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Morilog\Jalali\Jalalian;

class TicketController extends Controller
{
    private $obj, $objUsr, $objRpl;

    public function __construct()
    {
        $this->obj = new Ticket();
        $this->objUsr = new TicketUser();
        $this->objRpl = new TicketReply();
    }

    public function index()
    {
        try {
            $msg='Ticket fetched.';
            $data=[];
            if(auth('api')->user()->role==6){
                $tickets = Ticket::latest()->get();
            }else{
                $tickets = Ticket::has('me')->with('me')->get();

            }
            foreach ($tickets as $item)
            {
                $user=TicketUser::whereTicket($item->id)->firstOrFail()->user;
                $user=User::find($user);

                $data[]=[
                    "uuid" => $item->uuid,
                    "title"=> $item->title,
                    "user"=>$user->uuid,
                    'avatar' => Rest::$SARA.$user['avatar'],
                    "priority"=> intval($item->priority),
                    "message"=> $item->message,
                    "department"=> intval($item->department),
                    "status"=> intval($item->status),
                    "createdAt"=>$item->jCreated,
                    "updatedAt"=> $item->jUpdated,
                    "replies" => HResponse::replies($item->replies)
                ];
            }
            return Rest::success($msg,$data);
        }catch(\Exception $e) {
            return  Rest::error($e);
        }
    }


    public function reply(Request $r)
    {
        try {
            $msg="Store Reply Ticket";
                $ticket = Ticket::findUUID($r->input('ticket'));
                if ($ticket === null){
                    return Rest::badRequest();
                }
                $this->objRpl->ticket = $ticket['id'];
                $this->objRpl->user = auth('api')->id();
                $this->objRpl->message = $r->input('message');
                $this->objRpl->save();

            if(auth('api')->user()->role==6){
                $ticket->update([
                    'status'=>2
                ]);

            }
            else{
                $ticket->update([
                    'status'=>1
                ]);
            }

            return Rest::success($msg,null);
        }catch(\Exception $e) {
            return Rest::error($e);
        }
    }

    public function store(Request $request)
    {
        try {
            $msg="Ticket Stores";
            $this->obj->title=$request->input('title');
            $this->obj->priority=$request->input('priority');
            $this->obj->message=$request->input('message');
            $this->obj->department=$request->input('department');
            $this->obj->save();
            $this->objUsr->ticket = Ticket::findUUID($this->obj['uuid'])['id'];
            $this->objUsr->user = auth('api')->id();
            $this->objUsr->save();
            return Rest::success($msg,null);
        }catch(\Exception $e) {
            return Rest::error($e);
        }
    }

    public function show($uuid)
    {
        try {
            $msg="Ticket Fetched";
            $ticket = Ticket::with('replies')->findUUID($uuid);
            if ($ticket === null){
                return Rest::notFound();
            }
            $user=TicketUser::whereTicket($ticket->id)->firstOrFail()->user;
            $user=User::find($user);
            $data=[
                "uuid"=>$ticket->uuid,
                "user"=>$user->uuid,
                'avatar' => Rest::$SARA.$user['avatar'],
                "title"=> $ticket->title,
                "priority"=>intval($ticket->priority),
                "message"=> $ticket->message,
                "department"=> intval($ticket->department),
                "status"=> intval($ticket->status),
                "createdAt"=>$ticket->jCreated,
                "updatedAt"=> $ticket->jUpdated,
                'replies' => HResponse::replies($ticket->replies),
            ];
            return Rest::success($msg,$data);
        }catch(\Exception $e) {
            return  Rest::error($e);

        }
    }

}
