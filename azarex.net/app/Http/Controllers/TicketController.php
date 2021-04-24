<?php


namespace App\Http\Controllers;


use App\Models\Ticket;
use App\Models\TicketUser;
use Illuminate\Http\Request;

class TicketController extends Controller
{

    private $obj;

    public function __construct()
    {
        $this->obj = new Ticket();
    }

    public function index(){
        $items = Ticket::has('me')->with('me')->latest()->paginate(15);
        return view('tickets.index', compact('items'));
    }

    public function store(Request $r){
        try{
            $ticket = $r->validate([
                'title' => 'required',
                'message' => 'required',
                'department' => 'required',
                'priority' => 'required',
                'attachment' => 'nullable|file'
            ]);
            $ticket = Ticket::create($ticket);
            TicketUser::create([
                'ticket_id' => $ticket['id'],
                'user_id' => auth()->id()
            ]);
            return redirect()->route('panel.tickets.index');
        }catch (\Exception $e){
            return dd($e->getMessage());
        }
    }
}
