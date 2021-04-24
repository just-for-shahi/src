<?php

namespace Services\Comment\Repositories;

use Services\Comment\Models\Comment;
use App\Repository\Repository;

/**
 * Comment
 * @author Sajadweb
 * Sun Dec 27 2020 13:51:25 GMT+0330 (Iran Standard Time)
 */
class CommentRepository extends Repository implements ICommentRepository
{
    /**
     * The model being queried.
     *
     * @var Comment
     */
    public $model;
    public function __construct(Comment $model)
    {
        $this->model = new $model();
    }

    public function mapper($res)
    {
        $data = [];
        foreach ($res as $item) {
            $user = $item->user()->first();
            $data[] = [
                'uuid' => $item->uuid,
                'user' => [
                    "uuid" => $user->uuid,
                    "name" => $user->name,
                    "avatar" => getBaseUri($user->avatar)
                ],
                'comment' => $item->comment,
                'rate' => $item->rate,
                'likes' => $item->likes()->count(),
                'is_like' => !(!$item->isLike),
                'is_dislike' => !(!$item->isDislike),
                'dislikes' => $item->dislikes()->count(),
                'created_at' => $item->created_at,
                'replays' => $item->replays()->limit(x_count())->get()->map(function ($replay) {
                    $user2 = $replay->user()->first();
                    return [
                        'uuid' => $replay->uuid,
                        'user' => [
                            "uuid" => $user2->uuid,
                            "name" => $user2->name,
                            "avatar" => getBaseUri($user2->avatar)
                        ],
                        'comment' => $replay->comment,
                        'rate' => $replay->rate,
                        'is_like' => !(!$replay->isLike),
                        'is_dislike' => !(!$replay->isDislike),
                        'likes' => $replay->likes()->count(),
                        'dislikes' => $replay->dislikes()->count(),
                        'created_at' => $replay->created_at,
                    ];
                })
            ];
        }
        return $data;
    }

    public function show($uuid)
    {
        return $this->model
            ->with('replays')
            ->where('uuid', $uuid)
            ->whereStatus(config('mehrino.default_status.show'))
            ->first();
    }

    public function destroy($uuid)
    {
        return $this->model->me()->where('uuid', $uuid)->delete();
    }
}
