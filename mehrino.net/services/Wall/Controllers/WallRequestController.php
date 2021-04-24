<?php

namespace Services\Wall\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Services\Wall\Repositories\IWallRequestRepository;
use Services\Wall\Requests\WallRequest;
use Services\Wall\Requests\WallRequestRequest;

/**
 * Wall
 * @author Sajadweb
 * Fri Dec 25 2020 02:44:18 GMT+0330 (Iran Standard Time)
 */
class WallRequestController extends Controller
{

    private $repository;

    public function __construct(IWallRequestRepository $repository)
    {
        $this->repository = $repository;
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
                'wall_post as wallPost',
                'reject'
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
    public function store(WallRequestRequest $request)
    {
        try {
            $result = $this->repository->store($request->all());
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
    public function update($uuid, WallRequestRequest $request)
    {
        try {
            $result = $this->repository->update($uuid, $request->all());
            if ($result) return Ok(["item" => $result]);
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
