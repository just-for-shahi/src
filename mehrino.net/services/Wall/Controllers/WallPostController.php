<?php

namespace Services\Wall\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Services\Institute\Repositories\IInstituteRepository;
use Services\Wall\Repositories\IWallPostRepository;
use Services\Wall\Repositories\IWallRepository;
use Services\Wall\Repositories\IWallRequestRepository;
use Services\Wall\Requests\WallPostRequest;

/**
 * Wall
 * @author Sajadweb
 * Fri Dec 25 2020 02:44:18 GMT+0330 (Iran Standard Time)
 */
class WallPostController extends Controller
{

    private $repository;
    private $institute;
    private $wall;

    public function __construct(
        IWallPostRepository $repository,
        IInstituteRepository $institute,
        IWallRepository $wall
    )
    {
        $this->repository = $repository;
        $this->institute = $institute;
        $this->wall = $wall;
    }

    public function index()
    {
        try {

            $result = $this->repository->findMany([], ['*'], [
                "count" => x_count(),
                "page" => x_page()
            ]);
            if ($result->count() > 0) return OK($this->repository->mapper($result), [
                "x-count" => $result->count(),
                "x-page" => $result->currentPage(),
            ]);
            return NoContent204();
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }

    public function indexMe()
    {
        try {
            $result = $this->repository->findMany(['user' => auth()->id()], ['*'], [
                "count" => x_count(),
                "page" => x_page()
            ]);
            if ($result->count() > 0) return OK($this->repository->mapper($result), [
                "x-count" => $result->count(),
                "x-page" => $result->currentPage(),
            ]);
            return NoContent204();
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }

    public function indexWall($uuid)
    {
        try {
            $wall = $this->wall->findUUID($uuid);
            if (!$wall) return NotFound404();
            $result = $this->repository->findMany(['wall' => $wall->id], ['*'], [
                "count" => x_count(),
                "page" => x_page()
            ]);
            if ($result->count() > 0) return OK($this->repository->mapper($result), [
                "x-count" => $result->count(),
                "x-page" => $result->currentPage(),
            ]);
            return NoContent204();
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }

    public function indexInstitute($uuid)
    {
        try {
            $institute = $this->institute->findUUID($uuid);
            if (!$institute) return NotFound404();
            $result = $this->repository->findMany(['institutes' => $institute->id], ['*'], [
                "count" => x_count(),
                "page" => x_page()
            ]);
            if ($result->count() > 0) return OK($this->repository->mapper($result), [
                "x-count" => $result->count(),
                "x-page" => $result->currentPage(),
            ]);
            return NoContent204();
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }

    // Store
    public function store(WallPostRequest $request)
    {
        try {

            if ($request->has('institutes') && !empty($request->input('institutes'))) {
                $institute = $this->institute->findUUID($request->institutes);
                if (!$institute) return NotFound404();
            } else {
                $institute = null;
            }

            $wall = $this->wall->findUUID($request->wall);
            if (!$wall) return NotFound404();

            $data = $this->repository->preAction($request, $institute, $wall);
            $result = $this->repository->store($data);
            if ($result) {
                return Created201();
            }
            return BadRequest400();
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }

    // Show
    public function show($uuid)
    {
        try {
            $result = $this->repository->show($uuid);
            if ($result) return Ok($result);
            return NotFound404();
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }

    // Update
    public function update($uuid, Request $request)
    {
        try {
            if ($request->has('institutes') && !empty($request->institutes)) {
                $institute = $this->institute->findUUID($request->institutes);
                if (!$institute) return NotFound404();
                $request->merge([
                    "institute" => $institute->id
                ]);
            }
            $result = $this->repository->updated($uuid, $request);
            if ($result) return Ok();
            return BadRequest400();
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }

    // Destroy
    public function destroy($uuid)
    {
        try {
            $result = $this->repository->destroy($uuid);
            if ($result) return Ok();
            return BadRequest400();
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }
}
