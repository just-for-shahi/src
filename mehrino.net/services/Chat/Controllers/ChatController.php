<?php

namespace Services\Chat\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Services\Chat\Repositories\IChatRepository;
use Illuminate\Support\Facades\Redis;
use Services\Chat\Requests\ChatRequest;
use Services\Wall\Repositories\IWallPostRepository;

/**
 * Chat
 * @author Sajadweb
 * Sun Dec 27 2020 13:55:03 GMT+0330 (Iran Standard Time)
 */
class ChatController extends Controller
{
    private $repository;
    private $wall;

    public function __construct(
        IChatRepository $repository,
        IWallPostRepository $wall
    )
    {
        $this->repository = $repository;
        $this->wall = $wall;
    }

    public function getToken()
    {
        try {
            $user = auth()->user();
            $redis = Redis::get('user:' . $user->uuid);
            if ($redis) {
                return $redis;
            }
            $token = uuid();
            Redis::set('user:' . $user->uuid, json_encode(["user" => userMap($user), "token" => $token, "socket" => []]));
            Redis::set('token:' . $token, $user->uuid);
            return Ok(['token' => $token]);
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }

    public function indexMe()
    {
        try {
            $page = x_page() > 0 ? x_page() : 1;
            $count = x_count() ?? 15;

            $option = [];
            $result = $this->repository->findMany($option, [
                "count" => $count,
                "page" => $page
            ], ['*']);
            $totalResult = $result ? $result->toArray() : [];
            if (count($totalResult) > 0) return OK($this->repository->mapper($result), [
                "x-page" => $totalResult["current_page"],
                "x-count" => $totalResult["total"],
            ]);
            return NoContent204();
        } catch (\Exception $exp) {
            return InternalServerError500($exp);
        }
    }

    public function indexService($service, $uuid)
    {
        try {
            $service = $this->{$service}->db()->where('uuid', $uuid)->first();

            if (!$service) return NotFound404();

            $page = x_page() > 0 ? x_page() : 1;
            $count = x_count() ?? 15;

            $option = [];
            if (x_page() > x_count()) return BadRequest400();

            array_push($option, ['chatable_id', $service->id]);
            array_push($option, ['chatable_type', $service->getMorphClass()]);

            $result = $this->repository->findMany($option, [
                "count" => $count,
                "page" => $page
            ], ['*']);
            $totalResult = $result ? $result->toArray() : [];
            if (count($totalResult) > 0) return OK($totalResult["data"], [
                "x-page" => $totalResult["current_page"],
                "x-count" => $totalResult["total"],
            ]);
            return NoContent204();
        } catch (\Exception $exp) {
            return InternalServerError500($exp);
        }
    }

    public function store($service, $uuid)
    {
        try {

            $service = $this->{$service}->db()->where('uuid', $uuid)->first();
            if (!$service) return NotFound404();
            if ($service->chatExsits(auth()->id())) return OK();
            $data = $this->repository->preStore($service);
            if ($service->saveChat($data))
                return Ok();
            return BadRequest400();
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

    public function listChat($uuid, Request $request)
    {
        try {
            $page = x_page() > 0 ? x_page() : 1;
            $count = x_count() ?? 15;
            $result = $this->repository->findManyChat($uuid, [
                "count" => $count,
                "page" => $page
            ], ['*']);
            $totalResult = $result ? $result->toArray() : [];
            if (count($totalResult['data']) > 0) return OK($this->repository->mapperChat($result), [
                "x-page" => $totalResult["current_page"],
                "x-count" => $totalResult["total"],
            ]);
            return NoContent204();
        } catch (\Exception $exp) {
            return InternalServerError500($exp);
        }
    }

    public function storeChat($uuid, Request $request)
    {
        try {
            if ($this->repository->storeChat($uuid, $request)) {
                return Created201();
            }
            return BadRequest400();
        } catch (\Exception $exp) {
            return InternalServerError500($exp);
        }
    }
}
