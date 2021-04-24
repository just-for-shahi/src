<?php


namespace Services\Support\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Services\Support\Repositories\IFaqRepository;
use Services\Support\Requests\StoryRequests;

class FaqController extends Controller
{
    private $repository;

    public function __construct(IFaqRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        try {
            $list = $this->repository->all();
            if (count($list) > 0)
                return Ok($list);
            return NoContent204();
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }

}
