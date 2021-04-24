<?php


namespace App\Http\Controllers;


use App\Enums\SMSTemplate;
use App\Enums\SMSType;
use App\Helpers\SMSHelper;
use App\Helpers\TicketHelper;
use App\Http\Requests\StoreTicketReplyRequest;
use App\Http\Requests\StoreTicketRequest;
use App\Jobs\SendSMS;
use App\Models\Ticket;
use App\Models\TicketReply;
use App\Models\User;
use App\Scripts\Helpers\ValidationHelper;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;

class TicketController extends Controller
{

    private $entity;

    public function __construct()
    {
        $this->entity = new Ticket();
    }

    public function index()
    {
        try {
            return view('ticket.list', ['tickets' => Ticket::where('user_id', auth()->id())->latest()->paginate(15)]);
        } catch (\Exception $e) {
            Bugsnag::notifyException($e);
            return back()->withInput()->withErrors();
        }
    }

    public function create()
    {
        try {
            return view('ticket.create');
        } catch (\Exception $e) {
            Bugsnag::notifyException($e);
            return back()->withInput()->withErrors();
        }
    }

    public function store(StoreTicketRequest $request)
    {
        $request->validate([
            'attachment' => 'file|mimes:jpeg,png,zip'
        ]);

        $this->entity->user_id = auth()->id();
        $this->entity->title = $request->input('title');
        $this->entity->priority = $request->input('priority');
        $this->entity->message = $request->input('message');
        $this->entity->attachment = $request->hasFile('attachment') ? $request->file('attachment')->store('tickets/' . date('Y-m')) : null;
        $this->entity->department = $request->input('department');
        $this->entity->status = 0;
        $this->entity->save();
//        SendSMS::dispatch(SMSType::MILAD, config('mana.milad.mobile'), 'ثبت تیکت', SMSTemplate::MILAD);

        return redirect()->route('tickets.index');
    }

    public function show($ticket)
    {
        $this->entity = $this->entity->where(['user_id' => auth()->id(), 'uuid' => $ticket])
            ->with(['replies', 'replies.user'])->first();
        if ($this->entity === null) {
            return redirect()->route('tickets.index');
        }
        return view('ticket.show', ['ticket' => $this->entity]);
    }

    public function reply($uuid, StoreTicketReplyRequest $request)
    {
        $request->validate([
            'attachment' => ValidationHelper::get('attachment', false)
        ]);

        $this->entity = new TicketReply();
        $ticket = Ticket::where('uuid', $uuid)->first();
        if ($ticket['user_id'] != auth()->id() && auth()->user()->role != 6) {
            return back();
        }

        $this->entity->user_id = auth()->id();
        $this->entity->ticket = $ticket['id'];
        $this->entity->message = $request->input('message');
        $this->entity->attachment = $request->hasFile('attachment') ? $request->file('attachment')->store('tickets/' . date('Y-m')) : null;
        $this->entity->save();
        $status = 2;

        SendSMS::dispatch(SMSType::MILAD, config('mana.milad.mobile'), 'ثبت پاسخ تیکت', SMSTemplate::MILAD);
        Ticket::where('id', $ticket['id'])->update(['status' => $status]);


        flash('success');
        return back();
    }


}
