<?php

namespace Services\Report\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Services\Project\Repositories\IProjectRepository;
use Services\Report\Repositories\IReportRepository;
use Services\Voluntary\Repositories\IVoluntaryWorkRepository;

/**
 * Report
 * @author Sajadweb
 * Mon Jan 11 2021 21:18:28 GMT+0330 (Iran Standard Time)
 */
class ReportController extends Controller
{

    private $repository;
    private $project;
    private $voluntary;
    public function __construct(
        IProjectRepository $project,
        IVoluntaryWorkRepository $voluntary,
        IReportRepository $repository
    ) {
        $this->repository = $repository;
        $this->voluntary = $voluntary;
        $this->project = $project;
    }

    public function index($service, $uuid)
    {
        try {
            if (!in_array($service, getReportName())) {
                return BadRequest400();
            }

            $find = $this->{$service}->db()->where('uuid', $uuid)->first();
            if (!$find) {
                return NotFound404();
            }

            $result = $this->repository->paginateWithService($find, x_count(), x_page());
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

    public function store(Request $request, $service, $uuid)
    {
        try {
            if (!in_array($service, getReportName())) {
                return BadRequest400();
            }
            $service = $this->{$service}->db()->where('uuid', $uuid)->first();
            if (!$service) {
                return NotFound404();
            }
            $this->repository->saved($request, $service);
            return Ok();
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }
}
