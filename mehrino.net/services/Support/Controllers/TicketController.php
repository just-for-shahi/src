<?php


namespace Services\Support\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Services\Support\Repositories\IReplyRepository;
use Services\Support\Repositories\ITicketAccountRepository;
use Services\Support\Repositories\ITicketMapperRepository;
use Services\Support\Repositories\ITicketRepository;
use Illuminate\Http\Request;
use Services\Support\Requests\ReplyRequests;
use Services\Support\Requests\StoryRequests;

/**
 * TicketController
 * @author Sajadweb
 * 2020-06-06 09:50:45
 */
class TicketController extends Controller
{

    private $repository;
    private $accountRepository;
    private $replyRepository;
    private $mapper;

    public function __construct(ITicketRepository $repository,
                                ITicketAccountRepository $accountRepository,
                                IReplyRepository $replyRepository,
                                ITicketMapperRepository $mapper)
    {
        $this->accountRepository = $accountRepository;
        $this->repository = $repository;
        $this->replyRepository = $replyRepository;
        $this->mapper = $mapper;
    }

    public function index()
    {
        try {
            $result = $this->repository->paginate(x_count(), x_page());
            $data = $this->mapper->listTicket($result);
            if ($result->count() > 0)
                return Ok($data, [
                    "x-count" => $result->count(),
                    "x-page" => $result->currentPage(),
                ]);
            return NoContent204();
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }

    public function store(StoryRequests $request)
    {
        DB::beginTransaction();
        try {

            $data = $this->mapper->store($request->only(['title', 'priority', 'message', 'department']));
            if ($ticket = $this->repository->store($data)) {
                if ($this->accountRepository->store($ticket)) {
                    if ($request->has('attachment')) {
                        $path = $request->file('attachment.value')->store(uploadPath("ticket/$ticket->uuid/"));
                        $ticket->attachment($path, $request->input('attachment.type'), auth()->id());
                    }
                    DB::commit();
                    return Ok();
                }
            }
            Db::rollBack();
          return BadRequest400();
        } catch (\Exception $exp) {
            DB::rollBack();
            InternalServerError500($exp);
        }
    }

    public function show($uuid)
    {
        try {
            if ($ticket = $this->repository->show($uuid)) {
                return Ok($this->mapper->show($ticket));
            }
            return NotFound404();
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }

    public function reply(ReplyRequests $request, $uuid)
    {
        DB::beginTransaction();
        try {
            $reply_id = null;
            $ticket = $this->repository->show($uuid);
            if (!$ticket) {
                DB::rollBack();
                return NotFound404();
            }

            if ($reply = $this->replyRepository->store($this
                ->mapper
                ->reply($ticket, $request->input('message'), $reply_id))) {
                if ($request->hasFile('attachment')) {
                    $path = $request
                        ->file('attachment')
                        ->store(uploadPath("ticket/$ticket->uuid/reply"));
                    $reply->attachment($path, $request
                        ->file('attachment')->getClientMimeType(), \auth()->id());
                }
                DB::commit();
                return Ok();
            }
            DB::rollBack();
            return NotFound404();
        } catch (\Exception $exp) {
            DB::rollBack();
            InternalServerError500($exp);
        }
    }

    public function destroy($uuid)
    {
        try {
            if ($this->repository->destroy($uuid)) {
                return Ok();
            } else {
                return NotFound404();
            }
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }
}
