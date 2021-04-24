<?php

namespace Services\Wall\Repositories;

use Illuminate\Support\Facades\DB;
use Services\Institute\Response\ResInstitute;
use Services\Wall\Models\Wall;
use App\Repository\Repository;
use Services\Wall\Models\WallPost;
use Services\Attachment\Repositories\IAttachmentRepository;

/**
 * Wall
 * @author Sajadweb
 * Fri Dec 25 2020 02:44:18 GMT+0330 (Iran Standard Time)
 */
class WallPostRepository extends Repository implements IWallPostRepository
{
    /**
     * The model being queried.
     *
     * @var Wall
     */
    public $model;
    public $attachment;

    public function __construct(WallPost $model, IAttachmentRepository $attachment)
    {
        $this->model = new $model();
        $this->attachment = $attachment;
    }

    public function preAction($request, $institute, $wall)
    {
        $request->merge([
            'institutes' => $institute ? $institute->id : null,
            'wall' => $wall->id,
            'user' => auth()->id(),
        ]);

        $data = $request->only([
            'wall', 'institutes', 'title', 'user', 'content', 'latitude', 'longitude'
        ]);
        if ($request->has('galleries') && !empty($request->input('galleries'))) {
            $data['galleries']=$request->input('galleries');
        }
        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store(uploadPath("wall-post/cover/" . auth()->user()->uuid));
            $data['cover'] && imageOnQueue($data['cover']);
        }
        return $data;
    }

    public function store($data)
    {
        $result = $this->model->create([
            'user' => auth()->user()->id,
            'wall' => $data["wall"],
            'institutes' => $data["institutes"],
            'title' => $data["title"],
            'cover' => $data["cover"],
            'content' => $data["content"],
            'type' => 0,
            'latitude' => $data["latitude"],
            'longitude' => $data["longitude"],
            'status' => config('mehrino.default_status.store'),
        ]);
        $data["cover"] && imageOnQueue($data["cover"]);
        if (collect($data)->has('galleries')) {
            $galleries = $data['galleries'];
            $this->attachment->db()
            ->whereIn('uuid',  $galleries)
            ->me()
            ->update([
                'attachable_type'=> WAllPost::class,
                'attachable_id'=>  $result->id,
            ]);
        }

        if ($result) {
            $result->saveStatus(auth()->id(), config('mehrino.default_status.store'));
            return true;
        }

        return false;
    }

    /**
     * @param array $where
     * @param string[] $select
     * @param array $paginate
     * @return mixed
     */
    public function findMany($where, $columns, $paginate)
    {
        $model = $this->model;
        if (x_search() && !empty(x_search())) {
            $model = $model->where('title', 'like', "%" . x_search() . "%");
        }
        return $model
            ->where($where)
            ->whereStatus(config('mehrino.default_status.show'))
            ->has('wall')
            ->distance(x_lat(), x_long())
            //            ->select($columns)
            ->with(['institute', 'wall', 'user', 'isLike', 'isBookmark'])
            ->paginate($paginate["count"], '*', 'page', $paginate["page"]);
    }

    /**
     * @param $uuid
     * @return mixed
     */
    public function show($uuid)
    {

        $datum = $this->model
            ->where('uuid', $uuid)
            ->whereStatus(config('mehrino.default_status.show'))
            ->with(['institute', 'wall', 'attachments', 'user', 'visit', 'visits', 'likes', 'isLike', 'isBookmark'])
            //            ->select($select)
            ->first();
        if (!$datum) {
            return null;
        }

        $wall = $datum->wall()->first();
        if ($wall) {
            $wall = [
                'uuid' => $wall->uuid,
                'title' => $wall->title,
                'cover' => getBaseUri($wall->cover),
            ];
        }
        return [
            'uuid' => $uuid,
            'wall' => $wall,
            'user' => userMap($datum->user()->first()),
            'title' => $datum->title,
            'updatedAt' => $datum->updatedAt,
            'createdAt' => $datum->createdAt,
            'cover' => getBaseUri($datum->cover),
            'content' => $datum->content,
            'latitude' => $datum->latitude,
            'longitude' => $datum->longitude,
            'private' => $datum->private,
            "galleries" => attachMap($datum->attachments()->get()),
            'is_like' => !(!$datum->isLike),
            "likes" => $datum->likes()->count(),
            "visits" => $datum->visits()->count(),
            "visit" => !(!$datum->visit),
            'institute' => instituteMap($datum->institute()->first()),
            'is_bookmark' => !(!$datum->isBookmark)
        ];
    }


    public function updated($uuid, $request)
    {
        try {
            $data = [];
            $result = $this->model
                ->where([
                    'user' => auth()->user()->id,
                    'uuid' => $uuid
                ])
                ->first();
            if (!$result) return null;
            if ($request->hasFile('cover')) {
                $data['cover'] =  $request->file('cover')->store(uploadPath('wall-post/cover/' . auth()->user()->uuid));
                $data['cover'] && imageOnQueue($data['cover']);
                deleteAll($result->cover);
            }


            if ($request->has('institute'))
                $data["institutes"] = $request->institute;

            if ($request->has('title'))
                $data["title"] = $request->title;

            if ($request->has('content'))
                $data["content"] = $request->content;

            if ($request->has('latitude'))
                $data["latitude"] = $request->latitude;

            if ($request->has('latitude'))
                $data["longitude"] = $request->longitude;

            if ($request->has('private'))
                $data["private"] = $request->private;

            if ($request->has('galleries')) {
                $galleries = collect($request->input('galleries'));
                $this->attachment->db()
                ->whereIn('uuid',  $galleries)
                ->me()
                ->update([
                    'attachable_type'=> WallPost::class,
                    'attachable_id'=> $result->id,
                ]);
            }
            if (count($data) > 0) {
                $result = $result->update($data);
                if (empty($result)) return null;
            }
            return $result;
        } catch (\Exception $exp) {
            notifyException($exp);
            return false;
        }
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


    public function mapper($res)
    {
        $data = [];
        foreach ($res as $datum) {
            $wall = $datum->wall()->first();
            $data[] = [
                'wall' => [
                    'uuid' => $wall->uuid,
                    'title' => $wall->title,
                    'cover' => getBaseUri($wall->cover),
                ],
                'user' => userMap($datum->user()->first()),
                'title' => $datum->title,
                'uuid' => $datum->uuid,
                'cover' => getBaseUri($datum->cover),
                'content' => $datum->content,
                'is_like' => !(!$datum->isLike),
                'institute' => instituteMap($datum->institute()->first()),
                'is_bookmark' => !(!$datum->isBookmark)
            ];
        }

        return $data;
    }
}
