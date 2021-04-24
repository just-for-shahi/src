<?php

namespace Services\Voluntary\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Services\Voluntary\Repositories\IVoluntaryCertificateRepository;
use Services\Voluntary\Repositories\IVoluntaryRequestRepository;
use Services\Voluntary\Repositories\IVoluntaryWorkRepository;
use Services\Voluntary\Requests\VoluntaryCertificateRequest;
use Services\Voluntary\Requests\VoluntaryRequestRequest;

/**
 * Voluntary
 * @author nimadeve
 * Sun Dec 27 2020 14:01:39 GMT+0330 (Iran Standard Time)
 */
class VoluntaryCertificateController extends Controller
{

    private $repository;
    private $voluntary;

    public function __construct(IVoluntaryCertificateRepository $repository, IVoluntaryWorkRepository $voluntary)
    {
        $this->repository = $repository;
        $this->voluntary = $voluntary;
    }

    // List of Voluntary
    public function index()
    {
        try {
            $page = x_page() > 0 ? x_page() : 1;
            $count = x_count() ?? 15;

            $option = [];
            if (x_page() > x_count()) return BadRequest400();

            $select = [
                'uuid',
                'status',
                'created_at as createdAt',
                'updated_at as updatedAt',
                'user',
                'voluntary_work as voluntaryWork',
                'certificate'
            ];
            $result = $this->repository->findMany($option, [
                "count" => $count,
                "page" => $page
            ], $select);
            $totalResult = $result ? $result->toArray() : [];
            if (count($totalResult) > 0) return OK($totalResult["data"], [
                "x-page" => $totalResult["current_page"],
                "x-count" => $totalResult["total"],
            ]);
            return NoContent204();
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }

    // Store
    public function store(VoluntaryCertificateRequest $request)
    {
        try {
            $voluntary = $this->voluntary->findUUID($request->voluntary);
            if (!$voluntary) return NotFound404();
            $data = $this->repository->preAction($request, $voluntary);
            $result = $this->repository->store($data);
            if ($result) return Ok();
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
            if ($result) return Ok(["item" => $result]);
            return NoContent204();
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }

    // Update
    public function update($uuid, VoluntaryCertificateRequest $request)
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

    // Destroy
    public function destroy($uuid)
    {
        try {
            $result = $this->repository->destroy($uuid);
            if ($result) return Ok(["item" => $result]);
            return BadRequest400();
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }
}
