<?php

namespace App\Http\Controllers;

use App\Enums\Comment\CommentStatus;
use App\Enums\Like\LikeStatus;
use App\Facades\HResponse\HResponse;
use App\Facades\Rest\Rest;
use App\Http\Controllers\Course\Course;
use App\Http\Controllers\EBook\EBook;
use App\Http\Controllers\Event\Event;
use App\Http\Controllers\Podcast\Podcast;
use App\Http\Controllers\Story\Story;
use App\Models\Comment;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all() , [
                'uuid' => 'required',
                'type' => 'required',
                'comment' => 'required',
                'parent' => 'sometimes|nullable'
            ]);

            if ($validator->fails()) {
                return Rest::badRequest($validator->errors());
            }

            $uuid = $request->uuid;
            $type = $request->type;
            $comment = $request->comment;
            if (isset($request->parent)) {
                $parent = Comment::whereUuid($request->parent)->first();
                if (!$parent) {
                    return Rest::notFound();
                }
                $parent_id = $parent->id;
            } else {
                $parent_id = 0;
            }

            $user = auth('api')->user();

            switch ($type) {
                case 0:
                    $model = Course::whereUuid($uuid)->with(['comments'])->first();
                    break;
                case 1:
                    $model = EBook::whereUuid($uuid)->with(['comments'])->first();
                    break;
                case 2:
                    $model = Podcast::whereUuid($uuid)->with(['comments'])->first();
                    break;
                case 3:
                    $model = Event::whereUuid($uuid)->with(['comments'])->first();
                    break;
                case 4:
                    $model = Story::whereUuid($uuid)->with(['comments'])->first();
                    break;
            }

            if (!$model) {
                return Rest::notFound();
            }

            $store = $model->comments()->create([
                'user' => $user->id,
                'comment' => $comment,
                'commentable_type' => get_class($model),
                'commentable_id' => $model->id,
                'parent_id' => $parent_id,
                'status' => CommentStatus::APPROVED
            ]);

            $comment = Comment::whereUuid($store->uuid)->where('status' , CommentStatus::APPROVED)->with(['replies','replies.user','likes','user'])->first();

            $data = HResponse::comment($comment);

            return Rest::success('Comment Stored' , $data);
        } catch (\Exception $e) {
            return Rest::error($e);
        }
    }

    public function like(Request $request)
    {
        try {
            $validator = Validator::make($request->all() , [
                'uuid' => 'required',
            ]);

            if ($validator->fails()) {
                return Rest::badRequest($validator->errors());
            }

            $uuid = $request->uuid;
            $user = auth('api')->user();

            $comment = Comment::whereUuid($uuid)->first();

            if (!$comment) {
                return Rest::notFound();
            }

            $liked_before = Like::whereUser(auth('api')->id())
                ->where('likable_type' , get_class($comment))
                ->where('likable_id' , $comment->id)
                ->whereStatus(LikeStatus::LIKE)
                ->first();

            $disliked_before = Like::whereUser(auth('api')->id())
                ->where('likable_type' , get_class($comment))
                ->where('likable_id' , $comment->id)
                ->whereStatus(LikeStatus::DISLIKE)
                ->first();

            if ($disliked_before) {
                $disliked_before->delete();
            }

            if ($liked_before) {
                Like::whereUser(auth('api')->id())
                    ->where('likable_type' , get_class($comment))
                    ->where('likable_id' , $comment->id)
                    ->whereStatus(LikeStatus::LIKE)
                    ->delete();
                $msg = 'Comment Unliked';
            } else {
                $comment->likes()->create([
                    'user' => $user->id ,
                ]);
                $msg = 'Comment liked';
            }

            $liked_count = $comment->likes()->whereStatus(LikeStatus::LIKE)->count();
            $disliked_count = $comment->likes()->whereStatus(LikeStatus::DISLIKE)->count();

            return Rest::success($msg , ['like' => $liked_count , 'disliked' => $disliked_count]);
        } catch (\Exception $e) {
            return Rest::error($e);
        }
    }

    public function dislike(Request $request)
    {
        try {
            $validator = Validator::make($request->all() , [
                'uuid' => 'required',
            ]);

            if ($validator->fails()) {
                return Rest::badRequest($validator->errors());
            }

            $uuid = $request->uuid;
            $user = auth('api')->user();

            $comment = Comment::whereUuid($uuid)->first();

            if (!$comment) {
                return Rest::notFound();
            }

            $liked_before = Like::whereUser(auth('api')->id())
                ->where('likable_type' , get_class($comment))
                ->where('likable_id' , $comment->id)
                ->whereStatus(LikeStatus::LIKE)
                ->first();

            $disliked_before = Like::whereUser(auth('api')->id())
                ->where('likable_type' , get_class($comment))
                ->where('likable_id' , $comment->id)
                ->whereStatus(LikeStatus::DISLIKE)
                ->first();

            if ($liked_before) {
                $liked_before->delete();
            }

            if ($disliked_before) {
                Like::whereUser(auth('api')->id())
                    ->where('likable_type' , get_class($comment))
                    ->where('likable_id' , $comment->id)
                    ->whereStatus(LikeStatus::DISLIKE)
                    ->delete();
                $msg = 'Comment UnDisliked';
            } else {
                $comment->likes()->create([
                    'user' => $user->id ,
                    'status' => LikeStatus::DISLIKE
                ]);
                $msg = 'Comment Disliked';
            }

            $liked_count = $comment->likes()->whereStatus(LikeStatus::LIKE)->get()->count();
            $disliked_count = $comment->likes()->whereStatus(LikeStatus::DISLIKE)->get()->count();

            return Rest::success($msg , ['like' => $liked_count , 'disliked' => $disliked_count]);
        } catch (\Exception $e) {
            return Rest::error($e);
        }
    }
}
