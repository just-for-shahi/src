<?php


namespace App\Http\Controllers\Ticket;


use App\Enums\Account\Role;
use App\Enums\Ticket\Department;
use App\Enums\Ticket\Priority;
use App\Enums\Ticket\Status;
use App\Http\Controllers\Account\Account;
use App\Scripts\Helpers\ValidationHelper;
use Illuminate\Http\Request;

class Controller extends \App\Http\Controllers\Controller
{

    private $obj, $objUsr, $objRpl;

    public function __construct()
    {
        $this->obj = new Ticket();
        $this->objUsr = new TicketAccount();
        $this->objRpl = new TicketReply();
    }

    public function index()
    {
        $page_title = 'List Tickets';
        $items = Ticket::has('me')->with(['ticket_account'])->latest()->paginate();
        return view('tickets.index', compact('page_title', 'items'));
    }

    public function new()
    {
        $page_title = 'Send Ticket';
        return view('tickets.new', compact('page_title'));
    }

    public function reply($uuid, Request $r)
    {
        $ticket = Ticket::uuid($uuid)->first();
        if ($ticket === null) {
            abort(404);
        }

        $r->validate([
            'message' => ValidationHelper::get('TEXT'),
        ]);
        $this->objRpl->ticket_id = $ticket['id'];
        $this->objRpl->account_id = auth()->id();
        $this->objRpl->message = $r->input('message');
        $this->objRpl->save();

        if (auth()->user()->role == Role::ADMIN) {
            $ticket->update([
                'status' => Status::REPLIED
            ]);

        } else {
            $ticket->update([
                'status' => Status::WAITING
            ]);
        }
        return redirect()->route('tickets.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ValidationHelper::get('STRING'),
            'message' => ValidationHelper::get('TEXT'),
            'priority' => ValidationHelper::inArray([
                Priority::NORMAL,
                Priority::IMPORTANT,
                Priority::NON_SIGNIFICANT
            ]),
            'department' => ValidationHelper::inArray([
                Department::GENERAL,
                Department::FINANCE,
                Department::INVESTMENT,
                Department::UACCOUNTS,
                Department::HODHOD,
                Department::CORPORATIONS,
                Department::ADMINS,
            ])
        ]);

        $this->obj->title = $request->input('title');
        $this->obj->priority = $request->input('priority');
        $this->obj->message = $request->input('message');
        $this->obj->department = $request->input('department');
        $this->obj->save();
        $this->objUsr->ticket_id = Ticket::uuid($this->obj['uuid'])->first()->id;
        $this->objUsr->account_id = auth()->id();
        $this->objUsr->save();

        return redirect()->route('tickets.index');
    }

    public function show($uuid)
    {
        $page_title = 'Show Ticket';
        $ticket = Ticket::with('replies')->uuid($uuid)->firstOrFail();

        $account = TicketAccount::whereTicketId($ticket->id)->firstOrFail()->account_id;
        $account = Account::find($account);
        return view('tickets.show', compact('page_title', 'ticket', 'account'));
    }


    public function destroy($uuid)
    {
        $ticket = Ticket::uuid($uuid)->first();
        if ($ticket === null) {
            abort(404);
        }

        if ($ticket->can_be_deleted) {
            $ticket->delete();
            return redirect()->route('tickets.index');
        }

        abort(404);
    }

}
