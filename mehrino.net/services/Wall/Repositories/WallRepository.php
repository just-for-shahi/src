<?php

namespace Services\Wall\Repositories;


use App\Repository\Repository;
use Carbon\Carbon;
use Services\Wall\Models\Wall;

/**
 * Wall
 * @author Sajadweb
 * Fri Dec 25 2020 02:44:18 GMT+0330 (Iran Standard Time)
 */
class WallRepository extends Repository implements IWallRepository
{
    /**
     * The model being queried.
     *
     * @var Wall
     */
    public $model;

    public function __construct(Wall $model)
    {
        $this->model = new $model();
    }

    public function mapper($result)
    {
        $data = [];
        foreach ($result as $item) {
            $data[] = [
                'uuid' => $item->uuid,
                'title' => $item->title,
                'status' => $item->status,
                'latitude' => $item->latitude,
                'longitude' => $item->longitude,
                'private' => $item->private,
                'cover' => getBaseUri($item->cover),
                'institutes' => instituteMap($item->institutes()->first()),
                'user' => userMap($item->user()->first())

            ];
        }
        return $data;
    }

    public function store($request)
    {
        $wall =  $this->model->create([
            'user' => auth()->user()->id,
            'status' => config('mehrino.default_status.store'),
            'institutes' => $request->input("institutes", null),
            'title' => $request->input("title", null),
            'cover' => $request->hasFile('cover') ? $request->file('cover')->store(uploadPath('institutes/wall/' . auth()->user()->uuid)) : null,
            'description' => $request->input("description", null),
            'latitude' => $request->input("latitude", null),
            'longitude' => $request->input("longitude", null),
            'type' => $request->input("type", 0),
            'private' => $request->input("private", 0),
        ]);
        $wall->cover && imageOnQueue($wall->cover);
        return $wall;
    }

    /**
     * @param array $where
     * @param string[] $select
     * @param array $paginate
     * @return mixed
     */
    public function findMany($where, $select = ["*"], $paginate)
    {
        try {
            return $this->model
                ->with(['institutes', 'user'])
                ->where($where)
                ->whereStatus(config('mehrino.default_status.show'))
                ->select($select)
                ->withCount('wallPosts')
                ->orderBy('wall_posts_count', 'desc')
                ->latest()
                ->paginate($paginate['count'], '*', 'page', $paginate['page']);
        } catch (\Exception $exp) {
            notifyException($exp);
        }
    }

    /**
     * @param $uuid
     * @return mixed
     */
    public function show($uuid)
    {
        try {
            return $this->model
                ->where('uuid', $uuid)
                ->whereStatus(config('mehrino.default_status.show'))
                ->with(["institutes", "user"])
                ->first();
        } catch (\Exception $exp) {
            notifyException($exp);
        }
    }


    public function update($uuid, $request)
    {
        $data = [];
        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store(uploadPath('institutes/wall/' . auth()->user()->uuid));
            imageOnQueue($data['cover']);
        }

        if ($request->has('institutes'))
            $data["institutes"] = $request->institutes;

        if ($request->has('title'))
            $data["title"] = $request->title;

        if ($request->has('description'))
            $data["description"] = $request->description;

        if ($request->has('latitude'))
            $data["latitude"] = $request->latitude;

        if ($request->has('latitude'))
            $data["longitude"] = $request->longitude;

        if ($request->has('private'))
            $data["private"] = $request->private;

        return $this->model->where([
                'user' => auth()->user()->id,
                'uuid' => $uuid
            ])->update($data);
    }

    public function findUUID($uuid)
    {
        return $this->model
            ->where('uuid', $uuid)
            ->first();
    }


    public function destroy($uuid)
    {
        try {
            $user = $this->model->where([
                    'user' => auth()->user()->id,
                    'uuid' => $uuid
                ])->first();
            if ($user) {
                if ($user->delete()) {
                    return true;
                }
            }
            return false;
        } catch (\Exception $exp) {
            notifyException($exp);
            return false;
        }
    }

    public function paginate(int $count = 15, int $page = 1, array $columns = ['*'])
    {
        return $this->model->with(["institutes", "user"])->paginate($count, $columns, $pageName = null, $page);
    }
}
