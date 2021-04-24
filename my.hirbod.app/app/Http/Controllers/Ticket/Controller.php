<?php


namespace App\Http\Controllers\Ticket;


use App\HModels\User;
use App\Http\Requests\StoreTicketReplyRequest;
use App\Http\Requests\StoreTicketRequest;
use Illuminate\Http\Request;

class Controller extends \App\Http\Controllers\Controller
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
            $tickets = Ticket::has('me')->latest()->paginate(15);
            return view('tickets.index', compact('tickets'));
        }catch(\Exception $e) {
            return  dd($e);
        }
    }

    public function create(){
        try{
            return view('tickets.create');
        }catch (\Exception $e){
            return dd($e);
        }
    }


    public function reply($uuid, StoreTicketReplyRequest $r)
    {
        try {
            $ticket = Ticket::findUUID($uuid);
            if ($ticket === null){
                return abort(404);
            }
            $usr = auth()->user();
            $this->objRpl->ticket = $ticket['id'];
            $this->objRpl->user = $usr->id;
            $this->objRpl->message = $r->input('message');
            $this->objRpl->save();
            if($usr->role==6){
                $ticket->update([
                    'status'=>2
                ]);
            }
            else{
                $ticket->update([
                    'status'=>1
                ]);
            }
            return redirect()->route('tickets.index');
        }catch(\Exception $e) {
            return dd($e);
        }
    }

    public function store(StoreTicketRequest $request)
    {
        try {
            $this->obj->title=$request->input('title');
            $this->obj->priority=$request->input('priority');
            $this->obj->message=$request->input('message');
            $this->obj->department=$request->input('department');
            //@TODO: Handle attachments
            $this->obj->save();
            $this->objUsr->ticket = Ticket::findUUID($this->obj['uuid'])['id'];
            $this->objUsr->user = auth()->id();
            $this->objUsr->save();
            return redirect()->route('tickets.index');
        }catch(\Exception $e) {
            return dd($e);
        }
    }

    public function show($uuid)
    {
        try {
            $ticket = Ticket::with('replies')->findUUID($uuid);
            if ($ticket === null){
                return abort(404);
            }
            $user=TicketUser::whereTicket($ticket->id)->firstOrFail()->user;
            $user=User::find($user);
            return view('tickets.show', compact('ticket', 'user'));
        }catch(\Exception $e) {
            return dd($e);

        }
    }


}
