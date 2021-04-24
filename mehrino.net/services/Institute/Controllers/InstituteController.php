<?php

namespace Services\Institute\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Services\Institute\Repositories\IBranchRepository;
use Services\Institute\Repositories\IInstituteBoardMemberRepository;
use Services\Institute\Repositories\IInstituteRepository;
use Services\Institute\Repositories\IInstituteWorkHoursRepository;
use Services\Institute\Requests\InstituteRequest;
use Services\Institute\Requests\UpdateInstituteRequest;

/**
 * Institute
 * @author Sajadweb
 * Mon Dec 21 2020 14:19:14 GMT+0330 (Iran Standard Time)
 */
class InstituteController extends Controller
{
    private $repo_branch;
    private $repository;
    private $repo_work_hours;
    private $repo_board_member;

    public function __construct(
        IInstituteRepository $repository,
        IBranchRepository $repo_branch,
        IInstituteWorkHoursRepository $repo_work_hours,
        IInstituteBoardMemberRepository $repo_board_member
    )
    {
        $this->repository = $repository;
        $this->repo_branch = $repo_branch;
        $this->repo_work_hours = $repo_work_hours;
        $this->repo_board_member = $repo_board_member;
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

    public function store(InstituteRequest $request)
    {
        try {
            DB::beginTransaction();
            $branch = null;
            $work_hours = null;
            $board_member = null;
            $data = $this->repository->preStore($request);
            if (!$data) {
                return BadRequest400();
            }
            $institutes = $this->repository->store($data);
            if (!$institutes) {
                return BadRequest400();
            }
            if ($request->has('branch')) {
                $br = $this->repository->preBranchStore($request, $institutes,$this->repo_branch);
                if (!$br) {
                    DB::rollBack();
                    return BadRequest400();
                }
            }

            if ($request->has('work_hours')) {
                $br = $this->repository->preWorkHoursStore($request, $institutes);
                $work_hours = $this->repo_work_hours->store($br);
                if (!$work_hours) {
                    DB::rollBack();
                    return BadRequest400();
                }
            }
            if ($request->has('board_member')) {
                $br = $this->repository->preBoardMemberStore($request, $institutes);
                $board_member = $this->repo_board_member->insert($br);
                if (!$board_member) {
                    DB::rollBack();
                    return BadRequest400();
                }
            }
            DB::commit();
            return Ok();
        } catch (\Exception $exp) {
            DB::rollBack();
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

    public function update($uuid, UpdateInstituteRequest $request)
    {
        try {
            DB::beginTransaction();
            $institutes = $this->repository->findUUID($uuid);
            if (!$institutes) {
                return NotFound404();
            }
            $inst = $this->repository->preUpdate($request);
            $this->repository->update(['uuid' => $uuid], $inst);
            if ($request->has('branch')) {
                $this->repo_branch->updateAndInsert($request, $institutes);
            }
            if ($request->has('board_member')) {
                $this->repo_board_member->updateAndInsert($request, $institutes);
            }

            if ($request->has('work_hours')) {
                $this->repo_work_hours->updateAndInsert($request, $institutes);
            }
            DB::commit();
            return Ok();
        } catch (\Exception $exp) {
            DB::rollBack();
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
