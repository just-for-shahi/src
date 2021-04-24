<?php

namespace Services\Project\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Services\Institute\Repositories\IInstituteRepository;
use Services\Project\Repositories\IProjectRepository;
use Services\Project\Requests\StoreProjectRequest;
use Services\Project\Requests\UpdateProjectRequest;

/**
 * Project
 * @author Sajadweb
 * Mon Dec 21 2020 17:35:28 GMT+0330 (Iran Standard Time)
 */
class ProjectController extends Controller
{

    private $repository;
    private $institutes;

    public function __construct(IProjectRepository $repository, IInstituteRepository $institutes)
    {
        // todo add repo
        $this->repository = $repository;
        $this->institutes = $institutes;
    }

    public function getProjectsWithInstitute(string $uuid)
    {
        try {
            $institutes = $this->institutes->db()->where('uuid', $uuid)->first();
            if (!$institutes) {
                return NotFound404();
            }
            $result = $this->repository->paginateWithInstitute($institutes->id, x_count(), x_page());
            $data = $this->repository->mapper($result);
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

    public function index()
    {
        try {
            $result = $this->repository->paginate(x_count(), x_page());
            $data = $this->repository->mapper($result);
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

    public function myIndex()
    {
        try {
            $result = $this->repository->myPaginate(x_count(), x_page());
            $data = $this->repository->mapper($result);
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

    public function store(StoreProjectRequest $request)
    {
        try {
            $institutes = null;
            if ($request->has('institutes') && !empty($request->input('institutes'))) {
                $institutes = $this->institutes->db()->where('uuid', $request->input('institutes'))->first();
                if (!$institutes) {
                    return NotFound404();
                }
            }

            $data = $this->repository->preStore($request, $institutes);
            if (!$data) {
                return BadRequest400();
            }
            $result = $this->repository->store($data);
            if ($result) {
                return Created201();
            }
            return BadRequest400();
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }

    public function show($uuid)
    {
        try {
            $project = $this->repository->show($uuid);
            if ($project) {
                return Ok($project);
            }
            return  NotFound404();
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }

    public function update($uuid, Request $request)
    {
        try {
            $this->repository->updated($uuid, $request);
            return Ok();
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
