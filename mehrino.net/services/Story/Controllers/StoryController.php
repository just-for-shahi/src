<?php

namespace Services\Story\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Services\Story\Repositories\IStoryRepository;
use Services\Story\Requests\StoryRequest;

/**
 * Story
 * @author Sajadweb
 * Fri Dec 25 2020 02:41:52 GMT+0330 (Iran Standard Time)
 */
class StoryController extends Controller
{

    private $repository;

    public function __construct(IStoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function myIndex()
    {
        try {
            $result = $this->repository->db()->me()
                ->with(['user', 'visit', 'visits'])
                ->where('user', auth()->id())
                ->inDay()
                ->get();

            $data = $this->repository->mapper($result);
            if (count($data) > 0)
                return Ok($data);
            return NoContent204();
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }

    public function index()
    {
        try {
            $result = $this->repository->paginateUser(x_count(), x_page());
            $data = $this->repository->mapperUser($result);
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

    public function store(StoryRequest $request)
    {
        try {
            if ($this->repository->save($request))
                return Created201();
            return NotFound404();
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }

    public function show($uuid)
    {
        try {
            return Ok($this->repository->show($uuid));
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }

    public function update($uuid, Request $request)
    {
        try {
            return Update203($this->repository->updated($uuid, $request));
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }

    public function destroy($uuid)
    {
        try {
            if ($this->repository->destroy($uuid)) {
                return Accepted202();
            }
            return NotFound404();
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }
}
