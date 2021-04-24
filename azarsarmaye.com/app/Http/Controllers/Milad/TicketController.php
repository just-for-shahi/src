<?php


namespace App\Http\Controllers\Milad;


use App\Enums\SMSTemplate;
use App\Enums\SMSType;
use App\Helpers\TicketHelper;
use App\Http\Controllers\Controller;
use App\Jobs\SendSMS;
use App\Models\Ticket;
use App\Models\TicketReply;
use App\Models\User;
use App\Scripts\Helpers\ValidationHelper;
use Illuminate\Http\Request;

class TicketController extends Controller
{

    private $entity;

    public function __construct()
    {
        $this->entity = new Ticket();
    }

    public function index()
    {
        return view('admin.ticket.list',
            [
                'tickets' => Ticket::with('user')->latest()->paginate(15)
            ]);
    }

    public function create()
    {
        return view('admin.ticket.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'attachment' => ValidationHelper::get('attachment', false)
        ]);

        $this->entity->user_id = User::getByUsername()->id;
        $this->entity->title = $request->input('title');
        $this->entity->priority = $request->input('priority');
        $this->entity->message = $request->input('message');
        $this->entity->attachment = $request->hasFile('attachment') ? $request->file('attachment')->store('tickets/' . date('Y-m')) : null;
        $this->entity->department = $request->input('department');
        $this->entity->status = Ticket::WAITING_FOR_CUSTOMER;
        $this->entity->save();

        return redirect()->route('admin.tickets.index');
    }

    public function show(Ticket $ticket)
    {
        $ticket->load(['replies', 'replies.user']);
        return view('admin.ticket.show', compact('ticket'));
    }

    public function reply(Ticket $ticket, Request $request)
    {
        $request->validate([
            'attachment' => ValidationHelper::get('attachment', false)
        ]);

        $reply = new TicketReply();
        $reply->user_id = auth()->id();
        $reply->ticket = $ticket['id'];
        $reply->message = $request->input('message');
        $reply->attachment = $request->hasFile('attachment') ? $request->file('attachment')->store('tickets/' . date('Y-m')) : null;

        try {
            \DB::beginTransaction();
            $reply->save();
            $status = 1;
            Ticket::where('id', $ticket['id'])->update(['status' => $status]);
            \DB::commit();
        } catch (\Exception $exception) {
            \DB::rollBack();
            throw $exception;
        }

        SendSMS::dispatch(SMSType::TEMPLATE, $ticket->user->mobile, $ticket['id'], SMSTemplate::TICKET, "sms", TicketHelper::statusTextly($status));

        flash('success');
        return back();
    }

}
