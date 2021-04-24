<?php

namespace Services\Voluntary\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Services\Institute\Repositories\IInstituteRepository;
use Services\Voluntary\Repositories\IVoluntaryWorkRepository;
use Services\Voluntary\Repositories\IVoluntaryRequestRepository;
use Services\Voluntary\Requests\VoluntaryRequestRequest;
use Services\Voluntary\Requests\VoluntaryWorkRequest;

/**
 * Voluntary
 * @author nimadeve
 * Sun Dec 27 2020 14:01:39 GMT+0330 (Iran Standard Time)
 */
class VoluntaryWorkController extends Controller
{

    private $repository;
    private $institute;

    public function __construct(IVoluntaryWorkRepository $repository, IInstituteRepository $institute)
    {
        $this->repository = $repository;
        $this->institute = $institute;
    }

    // List of Voluntary
    public function index()
    {
        try {
            $page = x_page() > 0 ? x_page() : 1;
            $count = x_count() ?? 15;

            $option = [];
            if (!empty(x_search())) {
                array_push($option, ['title', 'like', '%' . x_search() . '%']);
            }

            $result = $this->repository->search($option, [
                "count" => $count,
                "page" => $page
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
    public function store(VoluntaryWorkRequest $request)
    {
        try {
            DB::beginTransaction();
            $institute = null;
            if ($request->has('institutes') && !empty($request->input('institutes'))) {
                $institute = $this->institute->findUUID($request->institutes);
                if (!$institute) return NotFound404();
            }
            $data = $this->repository->preAction($request, $institute);
            $result = $this->repository->store($data);
            if ($result) {
                DB::commit();
                return Created201();
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
            if ($result) return Ok($result);
            return NotFound404();
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }

    // Update
    public function update(Request $request, $uuid)
    {
        try {
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
