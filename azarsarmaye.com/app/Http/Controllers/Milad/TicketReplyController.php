<?php


namespace App\Http\Controllers\Milad;


use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\TicketReply;
use Illuminate\Http\Request;

class TicketReplyController extends Controller
{

    private $entity;

    public function __construct()
    {
        $this->entity = new TicketReply();
    }

    public function store(Request $request){
        $tid = $request->input('tid');
        $ticket = Ticket::find($tid);
        if ($ticket['user_id'] != auth()->id()){
            return back();
        }
        $this->entity->user = auth()->id();
        $this->entity->ticket = $tid;
        $this->entity->message = $request->input('message');
        $this->entity->attachment = $request->hasFile('attachment') ? $request->file('attachment')->store('tickets/'.date('Y-m')) : null;
        $this->entity->save();
        $status = 2;
        if (auth()->user()->role == 6){
            $status = 1;
        }
        Ticket::where(['id' => $tid, 'user_id' => auth()->id()])->update(['status' => $status]);
        return redirect()->route('tickets.index');
    }

}
