<?php

namespace Services\Status\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Services\Status\Repositories\IStatusRepository;
use Services\Institute\Repositories\IInstituteRepository;
use Services\Project\Repositories\IProjectRepository;
use Services\User\Repositories\IUserRepository;
use Services\Voluntary\Repositories\IVoluntaryWorkRepository;
use Services\Wall\Repositories\IWallPostRepository;

/**
 * Status
 * @author Sajadweb
 * Sat Jan 09 2021 19:57:43 GMT+0330 (Iran Standard Time)
 */
class StatusController extends Controller
{

    private $repository;
    private $project;
    private $wall;
    private $voluntary;
    private $user;
    private $instituteRepository;

    public function __construct(
        IStatusRepository $repository,
        IProjectRepository $project,
        IInstituteRepository $instituteRepository,
        IUserRepository $user,
        IVoluntaryWorkRepository $voluntary,
        IWallPostRepository $wall
    )
    {
        $this->user = $user;
        $this->instituteRepository = $instituteRepository;
        $this->repository = $repository;
        $this->project = $project;
        $this->voluntary = $voluntary;
        $this->wall = $wall;
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

    public function search(Request $request)
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

    public function userSearch($uuid, Request $request)
    {
        try {
            $user = $this->user->findUUID($uuid);
            if (!$user) {
                return NotFound404();
            }
            $result = $this->repository->paginateUser($user, x_count(), x_page());
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

    public function instituteSearch($uuid, Request $request)
    {
        try {
            $ins = $this->instituteRepository->db()->where('uuid',$uuid)->first();
            $result = $this->repository->paginateInstitute($ins, x_count(), x_page());
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
}
