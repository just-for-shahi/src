<?php


namespace Services\Support\Controllers;

use App\Http\Controllers\Controller;
use Services\Support\Repositories\ICallRequestRepository;
use Illuminate\Http\Request;
use Services\Support\Requests\CallStoryRequests as StoryRequests;

/**
 * CallRequestController
 * @author Sajadweb
 * 2020-06-12 04:18:53
 */
class CallRequestController extends Controller
{

    private $repository;

    public function __construct(ICallRequestRepository $repository)
    {
        $this->repository = $repository;
    }

    public function store(StoryRequests $request)
    {
        try {
            if ($this->repository->store($request->only(['name', 'phone','message']))) {
                return Ok();
            }
            return  BadRequest400();
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }

    public function destroy($uuid)
    {
        try {
            return Ok($this->repository->destroy($uuid));
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }
}
