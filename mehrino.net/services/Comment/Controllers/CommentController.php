<?php
namespace Services\Comment\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Services\Comment\Repositories\ICommentRepository;
use Services\Comment\Requests\CommentRequest;
use Services\Project\Repositories\IProjectRepository;
use Services\Voluntary\Repositories\IVoluntaryWorkRepository;

/**
 * Comment
 * @author Sajadweb
 * Sun Dec 27 2020 13:51:25 GMT+0330 (Iran Standard Time)
 */
class CommentController extends Controller{

    private $repository;
    private $project;
    private $voluntary;
    public function __construct(ICommentRepository $repository, IProjectRepository $project, IVoluntaryWorkRepository $voluntaryWorkRepository){
        $this->repository = $repository;
        $this->project = $project;
        $this->voluntary = $voluntaryWorkRepository;
    }

    public function index($service, $uuid)
    {
        try {

            if (in_array($service, ['project','voluntary'])) {
                $service = $this->{$service}->db()->where('uuid', $uuid)->first();
                if ($service) {
                    $result = $service->comments()
                        ->with('user')
                        ->orderBy('created_at', 'desc')
                        ->whereStatus(config('mehrino.default_status.show'))
                        ->paginate(x_count(), ['*'], null, x_page());
                    $data = $this->repository->mapper($result);
                    if ($result->count()) {
                        return Ok($data, [
                            "x-count" => $result->count(),
                            "x-page" => $result->currentPage(),
                        ]);
                    } else {
                        return NoContent204();
                    }
                } else {
                    return NotFound404();
                }
            } else {
                return BadRequest400();
            }
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }

    public function store(CommentRequest $request, $service, $uuid)
    {
        try {
            if (in_array($service, ['project','voluntary'])) {
                $service = $this->{$service}->db()
                    ->where('uuid', $uuid)
                    ->whereStatus(config('mehrino.default_status.show'))
                    ->first();
                if(!$service){
                    return NotFound404();
                }
                $request->merge(['user' => auth()->id()]);
                $request->merge(['status' => config('mehrino.default_status.store')]);
                $data = $request->only(['comment' , 'user' , 'status']);
                if ($service->comments()->create($data)) {
                    return Ok();
                } else {
                    return BadRequest400();
                }
            } else {
                return BadRequest400();
            }
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }

    public function indexReplay($uuid)
    {
        try {
            $comment = $this->repository->show($uuid);
            if ($comment) {
                $result = $comment->replays()
                ->with('user')
                ->whereStatus(config('mehrino.default_status.show'))
                ->orderBy('created_at', 'desc')
                ->paginate(x_count(), ['*'], null, x_page());
                $data = $this->repository->mapper($result);
                if ($result->count()) {
                    return Ok($data, [
                        "x-count" => $result->count(),
                        "x-page" => $result->currentPage(),
                    ]);
                } else {
                    return NoContent204();
                }
            } else {
                return NotFound404();
            }
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }

    public function replay(CommentRequest $request, $uuid)
    {
        try {
            $comment = $this->repository->show($uuid);
            if ($comment) {
                $request->merge(['user' => auth()->id()]);
                $request->merge(['status' => config('mehrino.default_status.store')]);
                $data = $request->only(['comment' , 'user' , 'status']);
                if ($comment->replays()->create($data)) {
                    return Ok();
                } else {
                    return BadRequest400();
                }
            } else {
                return NotFound404();
            }
        } catch (\Exception $exp) {
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
