<?php

namespace Services\Project\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Services\Project\Repositories\IProjectReportRepository;
use Services\Project\Repositories\IProjectRepository;
use Services\Project\Requests\StoreProjectReportRequest;

/**
 * ProjectReport
 * @author Sajadweb
 * Mon Jan 04 2021 03:21:07 GMT+0330 (Iran Standard Time)
 */
class ProjectReportController extends Controller
{

    private $repository;
    private $project;

    public function __construct(IProjectReportRepository $repository, IProjectRepository $project)
    {
        // todo add repo
        $this->repository = $repository;
        $this->project = $project;
    }

    public function index($project_id)
    {
        try {
            $project = $this->project->db()->where('uuid',$project_id)->first();
            if (!$project) {
                return NotFound404();
            }
            $result = $this->repository->paginateWithProject($project->id,x_count(), x_page());
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

    public function store($project_id, StoreProjectReportRequest $request)
    {
        try {
            $project = $this->project->db()->me()->where('uuid', $project_id)->first();
            if (!$project) {
                return NotFound404();
            }
            $this->repository->saved($request, $project);
            return Ok();
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
            return Ok($this->repository->update($uuid, $request->all()));
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
