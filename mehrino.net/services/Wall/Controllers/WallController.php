<?php

namespace Services\Wall\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Services\Institute\Repositories\IInstituteRepository;
use Services\Wall\Repositories\IWallRepository;
use Services\Wall\Repositories\IWallRequestRepository;
use Services\Wall\Requests\WallRequest;

/**
 * Wall
 * @author Sajadweb
 * Fri Dec 25 2020 02:44:18 GMT+0330 (Iran Standard Time)
 */
class WallController extends Controller
{

    private $repository;
    private $institutes;

    public function __construct(IWallRepository $repository, IInstituteRepository $institutes)
    {
        // todo add repo
        $this->repository = $repository;
        $this->institutes = $institutes;
    }

    // List of Voluntary
    public function index()
    {
        try {
            $option = [];
            if (!empty(x_search())) {
                array_push($option, ['title', 'like', '%' . x_search() . '%']);
            }
            $select = [
                'uuid',
                'status',
                'created_at as createdAt',
                'user',
                'institutes',
                'title',
                'cover',
                'description',
                'latitude',
                'longitude',
                'type',
                'private',
            ];
            $result = $this->repository->findMany($option, $select, [
                "count" => x_count(),
                "page" => x_page()
            ]);
            $totalResult = $result ? $result->toArray() : [];
            if (count($totalResult["data"]) > 0) return OK($this->repository->mapper($result), [
                "x-page" => $totalResult["current_page"],
                "x-count" => $totalResult["total"],
            ]);
            return NoContent204();
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }

    public function myIndex()
    {
        try {
            $page = x_page() > 0 ? x_page() : 1;
            $count = x_count() ?? 15;
            $option = ["user" => auth()->id()];
            if (!empty(x_search())) {
                array_push($option, ['title', 'like', '%' . x_search() . '%']);
            }
            if (x_type() >= 0 && x_type() != null) {
                array_push($option, ['type', x_type()]);
            }
            $select = [
                'uuid',
                'status',
                'created_at as createdAt',
                'user',
                'institutes',
                'title',
                'cover',
                'description',
                'latitude',
                'longitude',
                'type',
                'private',
            ];
            $result = $this->repository->findMany($option, $select, [
                "count" => $count,
                "page" => $page
            ]);
            $totalResult = $result ? $result->toArray() : [];
            if (count($totalResult["data"]) > 0) return OK($this->repository->mapper($result), [
                "x-page" => $totalResult["current_page"],
                "x-count" => $totalResult["total"],
            ]);
            return NoContent204();
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }

    // Store
    public function store(WallRequest $request)
    {
        try {
            $institute = null;
            if ($request->has('institutes') && !empty($request->input('institutes'))) {
                $institute = $this->institutes->findUUID($request->institutes);
                if (!$institute) return NotFound404();
            }

            $request->merge(['institutes' => $institute ? $institute->id : null]);
            $result = $this->repository->store($request);
            if ($result) return Created201();
            return BadRequest400();
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }

    // Show
    public function show($uuid)
    {
        try {
            $find = $this->repository->show($uuid);
            if (!$find) {
                return NotFound404();
            }
            $item = collect($find);
            if ($item) {
                if ($item->has('institutes') && isset($item['institutes']))
                    $item['institutes'] = [
                        'uuid' => $item["institutes"]['uuid'],
                        'title' => $item["institutes"]['title'],
                        'logo' => getBaseUri($item["institutes"]['logo'])
                    ];
                $item['createdAt'] = $item["created_at"];
                $item['cover'] = getBaseUri($item['cover']);
                if ($item->has('user'))
                    $item['user'] = [
                        'uuid' => $item["user"]['uuid'],
                        'name' => $item["user"]['name'],
                        'avatar' => getBaseUri($item["user"]['avatar'])
                    ];
                return Ok($item->only([
                    'uuid',
                    'status',
                    'createdAt',
                    'user',
                    'institutes',
                    'title',
                    'cover',
                    'description',
                    'latitude',
                    'longitude',
                    'private',
                ]));
            }
            return NotFound404();
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }

    // Update
    public function update($uuid, WallRequest $request)
    {
        try {
            $result = $this->repository->update($uuid, $request);
            if ($result) return Update203();
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
