<?php

namespace Services\Voluntary\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Services\Voluntary\Repositories\IVoluntaryRequestRepository;
use Services\Voluntary\Repositories\IVoluntaryWorkRepository;
use Services\Voluntary\Requests\VoluntaryRequestRequest;

/**
 * Voluntary
 * @author nimadeve
 * Sun Dec 27 2020 14:01:39 GMT+0330 (Iran Standard Time)
 */
class VoluntaryRequestController extends Controller
{

    private $repository;
    private $voluntary;

    public function __construct(IVoluntaryRequestRepository $repository, IVoluntaryWorkRepository $voluntary)
    {
        // todo add repo
        $this->repository = $repository;
        $this->voluntary = $voluntary;
    }

    public function index($uuid)
    {
        try {
            $voluntary = $this->voluntary->findUUID($uuid);
            if (!$voluntary) return NotFound404();
            $option = [];
            array_push($option, ['voluntary_work', $voluntary->id]);
            $result = $this->repository->search($option, [
                "count" => x_count(),
                "page" => x_page()
            ]);
            if ($result->count() > 0) return OK($this->repository->mapper($result), [
                "x-page" => $result->currentPage(),
                "x-count" => $result->count(),
            ]);
            return NoContent204();
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }

    // Store
    public function store($uuid, VoluntaryRequestRequest $request)
    {
        DB::beginTransaction();
        try {
            $voluntary = $this->voluntary->findUUID($uuid);
            if (!$voluntary) return BadRequest400();
            $repo = $voluntary->voluntaryRequests()->where([
                "user" => auth()->id()
            ])->first();
            if ($repo) return NotFound404();

            $data = $this->repository->preAction($request, $voluntary);
            $result = $this->repository->store($data);
            if ($result) {
                if ($this->repository->activityInc($voluntary)) {
                    DB::commit();
                    return Ok();
                }
            }
            DB::rollBack();
            return BadRequest400();
        } catch (\Exception $exp) {
            DB::rollBack();
            InternalServerError500($exp);
        }
    }

    // Show
    public function show($uuid)
    {
        try {
            $result = $this->repository->show($uuid);
            if ($result) return Ok(["item" => $result]);
            return NoContent204();
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }

    // Update
    public function update($uuid, VoluntaryRequestRequest $request)
    {
        try {
            $voluntary = $this->voluntary->findUUID($request->voluntary);
            if (!$voluntary) return NotFound404();
            $data = $this->repository->preAction($request, $voluntary);
            $result = $this->repository->update($uuid, $data);
            if ($result) return Ok();
            return BadRequest400();
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }

    // Update
    public function reject($uuid)
    {
        try {
            $result = $this->repository->reject($uuid);
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
