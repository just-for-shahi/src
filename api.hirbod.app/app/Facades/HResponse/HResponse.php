<?php


namespace App\Facades\HResponse;


use App\Enums\Comment\CommentStatus;
use App\Enums\Like\LikeStatus;
use App\Facades\HHash\HHash;
use App\Facades\Rest\Rest;
use App\Http\Controllers\Account\User;
use App\Http\Controllers\Support\Ticket;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;

class HResponse
{
    /**
     * @param $tags
     * @return array
     */
    public static function tags($tags)
    {
        $items = [];
        try {
            foreach ($tags as $tag) {
                $items[] = [
                    'uuid' => $tag->uuid,
                    'title' => $tag->name,
                    'color' => $tag->color,
                    'photo' => Rest::tempUrl($tag->photo),
                    'createdAt' => $tag->jCreated,
                    'updatedAt' => $tag->jUpdated
                ];
            }
        } catch (\Exception $e) {
            Bugsnag::notifyException($e);
        }
        return $items;
    }

    /**
     * @param $categories
     * @return array
     */
    public static function categories($categories)
    {
        $items = [];
        try {
            foreach ($categories as $category) {
                $items[] = [
                    'uuid' => $category->uuid,
                    'title' => $category->name,
                    'color' => $category->color,
                    'photo' => Rest::tempUrl($category->photo),
                    'type' => $category->type,
                    'createdAt' => $category->jCreated,
                    'updatedAt' => $category->jUpdated
                ];
            }
        } catch (\Exception $e) {
            Bugsnag::notifyException($e);
        }
        return $items;
    }

    /**
     * @param $publishers
     * @return array
     */
    public static function publishers($publishers)
    {
        $items = [];
        try {
            foreach ($publishers as $publisher) {
                $items[] = [
                    'uuid' => $publisher->uuid,
                    'title' => $publisher->name,
                    'createdAt' => $publisher->jCreated,
                    'updatedAt' => $publisher->jUpdated
                ];
            }
        } catch (\Exception $e) {
            Bugsnag::notifyException($e);
        }
        return $items;
    }

    /**
     * @param $writers
     * @return array
     */
    public static function writers($writers)
    {
        $items = [];
        try {
            foreach ($writers as $writer) {
                $items[] = [
                    'uuid' => $writer->uuid,
                    'title' => $writer->name,
                    'createdAt' => $writer->jCreated,
                    'updatedAt' => $writer->jUpdated
                ];
            }
        } catch (\Exception $e) {
            Bugsnag::notifyException($e);
        }
        return $items;
    }

    public static function replies($replies)
    {
        $items = [];
        try {
            foreach ($replies as $reply) {

                $user = User::Find($reply->user);
                $items[] = [
                    'uuid' => $reply->uuid,
                    'role' => $user['role'],
                    'avatar' => Rest::tempUrl($user['avatar']),
//                    'reply' => $reply->reply === null ? null : Ticket::find($reply->reply)['uuid'],
                    'reply' => Ticket::find($reply->ticket)['uuid'],
                    'user' => User::find($reply->user)['uuid'],
                    'message' => $reply->message,
                    'createdAt' => $reply->jCreated,
                ];
            }
            return $items;
        } catch (\Exception $e) {
            Bugsnag::notifyException($e);
        }
        return $items;
    }

    public static function ebooks($ebooks)
    {
        $items = [];
        try {
            foreach ($ebooks as $item) {
                $items[] = [
                    'uuid' => $item->uuid,
                    'title' => $item->title,
                    'photo' => Rest::tempUrl($item->cover),
                    'description' => $item->description,
                    'introduction' => $item->introduction,
                    'readers' => $item->readers,
                    'pages' => intval($item->pages),
                    'sample' => Rest::tempUrl($item->sample),
                    'isbn' => $item->isbn,
                    'level' => $item->level,
                    'rate' => 4.1,
                    'price' => ((count($item->prices) == 0) ? 0 : $item->prices()->latest()->first()->price),
                    'sampleToken' => HHash::hash($item->sample_token),
                    'sampleToken2' => $item->sample_token,
                    'publisher' => HResponse::publishers($item->publishers),
                    'writers' => HResponse::writers($item->writers),
                    'tags' => HResponse::tags($item->tags),
                    'categories' => HResponse::categories($item->categories),
                    'createdAt' => $item->jCreated,
                    'updatedAt' => $item->jUpdated
                ];
            }
        } catch (\Exception $e) {
            return Rest::error($e);
        }
        return $items;
    }

    public static function ebooksRelated($items , $uuid)
    {
        $data = [];
        try {
            foreach ($items->ebooks as $item) {
                if ($item->uuid !== $uuid) {
                    $data[] = [
                        'uuid' => $item->uuid,
                        'title' => $item->title,
                        'photo' => Rest::tempUrl($item->cover),
                        'description' => $item->description,
                        'introduction' => $item->introduction,
                        'readers' => $item->readers,
                        'pages' => intval($item->pages),
                        'sample' => Rest::tempUrl($item->sample),
                        'isbn' => $item->isbn,
                        'level' => $item->level,
                        'rate' => 4.1,
                        'price' => ((count($item->prices) == 0) ? 0 : $item->prices()->latest()->first()->price),
                        'sampleToken' => HHash::hash($item->sample_token),
                        'sampleToken2' => $item->sample_token,
                        'publisher' => HResponse::publishers($item->publishers),
                        'writers' => HResponse::writers($item->writers),
                        'tags' => HResponse::tags($item->tags),
                        'categories' => HResponse::categories($item->categories),
                        'createdAt' => $item->jCreated,
                        'updatedAt' => $item->jUpdated
                    ];
                }
            }
        } catch (\Exception $e) {
            return Rest::error($e);
        }
        return $data;
    }

    public static function podcasts($podcasts)
    {
        $items = [];
        try {
            foreach ($podcasts as $item) {
                $price = 0;
                foreach ($item->prices as $price) {
                    $price = $price->price;
                }
                $items[] = [
                    'uuid' => $item->uuid,
                    'title' => $item->title,
                    'logo' => Rest::tempUrl($item->logo),
                    'photo' => Rest::tempUrl($item->cover),
                    'description' => $item->description,
                    'price' => $price,
                    'rate' => 3.9,
                    'narrator' => 'Hirbod',
                    'episodes' => HResponse::episodes($item->episodes),
                    'tags' => HResponse::tags($item->tags),
                    'categories' => HResponse::categories($item->categories),
                    'createdAt' => $item->jCreated,
                    'updatedAt' => $item->jUpdated
                ];
            }
        } catch (\Exception $e) {
            Bugsnag::notifyException($e);
        }
        return $items;
    }

    public static function podcastsRelated($items , $uuid)
    {
        $data = [];
        try {
            foreach ($items->podcasts as $item) {
                if ($item->uuid !== $uuid) {
                    $price = 0;
                    foreach ($item->prices as $price) {
                        $price = $price->price;
                    }
                    $data[] = [
                        'uuid' => $item->uuid,
                        'title' => $item->title,
                        'logo' => Rest::tempUrl($item->logo),
                        'photo' => Rest::tempUrl($item->cover),
                        'description' => $item->description,
                        'price' => $price,
                        'rate' => 3.9,
                        'narrator' => 'Hirbod',
                        'episodes' => HResponse::episodes($item->episodes),
                        'tags' => HResponse::tags($item->tags),
                        'categories' => HResponse::categories($item->categories),
                        'createdAt' => $item->jCreated,
                        'updatedAt' => $item->jUpdated
                    ];
                }
            }
        } catch (\Exception $e) {
            Bugsnag::notifyException($e);
        }
        return $data;
    }

    public static function episodes($episodes, $granted = false)
    {
        $items = [];
        try {
            foreach ($episodes as $item) {
                $items[] = [
                    'uuid' => $item->uuid,
                    'title' => $item->title,
                    'plays' => $item->plays,
                    'description' => $item->description,
                    'file' => $granted ? Rest::tempUrl($item->file) : null,
                    'plus' => $item->plus,
                ];
            }
        } catch (\Exception $e) {
            Bugsnag::notifyException($e);
        }
        return $items;
    }

    public static function courses($items, $granted = false)
    {
        try {
            $data = [];
            foreach ($items as $item) {
                $data[] = [
                    'uuid' => $item->uuid,
                    'title' => $item->title,
                    'photo' => Rest::tempUrl($item->cover),
                    'description' => $item->description,
                    'introduction' => $item->introduction,
                    'students' => $item->students,
                    'duration' => $item->duration,
                    'level' => $item->level,
                    'status' => $item->status,
                    'author' => User::find($item->user)->username,
                    'rate' => 4.2,
                    'lectures' => self::lectures($item->lectures, $granted),
                    'price' => ((count($item->prices) == 0) ? 0 : $item->prices[0]->price),
                    'categories' => self::categories($item->categories),
                    'tags' => self::tags($item->tags)
                ];
            }
            return $data;
        } catch (\Exception $e) {
            return Rest::error($e);
        }
    }

    public static function coursesRelated($items, $granted = false , $uuid = null)
    {
        try {
            $data = [];
            foreach ($items->courses as $item) {
                if ($item->uuid !== $uuid) {
                    $data[] = [
                        'uuid' => $item->uuid,
                        'title' => $item->title,
                        'photo' => Rest::tempUrl($item->cover),
                        'description' => $item->description,
                        'introduction' => $item->introduction,
                        'students' => $item->students,
                        'duration' => $item->duration,
                        'level' => $item->level,
                        'status' => $item->status,
                        'author' => User::find($item->user)->username,
                        'rate' => 4.2,
                        'lectures' => self::lectures($item->lectures, $granted),
                        'price' => ((count($item->prices) == 0) ? 0 : $item->prices()->latest()->first()->price),
                        'categories' => self::categories($item->categories),
                        'tags' => self::tags($item->tags)
                    ];
                }
            }
            return $data;
        } catch (\Exception $e) {
            return Rest::error($e);
        }
    }

    public static function lectures($items, $granted = false)
    {
        $data = [];
        try {
            foreach ($items as $item) {
                $data[] = [
                    'uuid' => $item->uuid,
                    'title' => $item->title,
                    'duration' => $item->duration,
                    'description' => $item->description,
                    'type' => $item->type,
                    'plus' => $item->plus,
                    'status' => $item->status,
                    'file' => $granted ? Rest::tempUrl($item->file) : null
                ];
//                if ($granted){
//                    $data['file'] = Rest::tempUrl($item->file);
//                }
            }
        } catch (\Exception $e) {
            Rest::error($e);
        }
        return $data;
    }

    public static function comment($item)
    {
        $data = [];
        try {
            $data = [
                'uuid' => $item->uuid,
                'user' => $item->user()->first()->username,
                'comment' => $item->comment,
                'likes' => $item->likes()->whereStatus(LikeStatus::LIKE)->count(),
                'dislikes' => $item->likes()->whereStatus(LikeStatus::DISLIKE)->count(),
                'liked_before' => $item->likes()->whereStatus(LikeStatus::LIKE)->whereUser(auth('api')->id())->first() ? true : false,
                'disliked_before' => $item->likes()->whereStatus(LikeStatus::DISLIKE)->whereUser(auth('api')->id())->first() ? true : false,
                'replies_count' => count($item->replies),
                'replies' => self::commentReplies($item->replies),
                'createdAt' => $item->jCreated,
                'updatedAt' => $item->jUpdated
            ];
            return $data;
        } catch(\Exception $e) {
            return Rest::error($e);
        }
    }

    public static function comments($items)
    {
        $data = [];
        try {
            foreach ($items as $item) {
                $data[] = [
                    'uuid' => $item->uuid,
                    'user' => $item->user()->first()->username,
                    'comment' => $item->comment,
                    'likes' => $item->likes()->whereStatus(LikeStatus::LIKE)->count(),
                    'dislikes' => $item->likes()->whereStatus(LikeStatus::DISLIKE)->count(),
                    'liked_before' => $item->likes()->whereStatus(LikeStatus::LIKE)->whereUser(auth('api')->id())->first() ? true : false,
                    'disliked_before' => $item->likes()->whereStatus(LikeStatus::DISLIKE)->whereUser(auth('api')->id())->first() ? true : false,
                    'replies_count' => count($item->replies),
                    'replies' => self::commentReplies($item->replies),
                    'createdAt' => $item->jCreated,
                    'updatedAt' => $item->jUpdated
                ];
            }
            return $data;
        } catch(\Exception $e) {
            return Rest::error($e);
        }
    }

    public static function commentReplies($items)
    {
        $data = [];
        try {
            foreach ($items as $item) {
                $data[] = [
                    'uuid' => $item->uuid,
                    'user' => $item->user()->first()->username,
                    'comment' => $item->comment,
                    'likes' => $item->likes()->whereStatus(LikeStatus::LIKE)->count(),
                    'dislikes' => $item->likes()->whereStatus(LikeStatus::DISLIKE)->count(),
                    'liked_before' => $item->likes()->whereStatus(LikeStatus::LIKE)->whereUser(auth('api')->id())->first() ? true : false,
                    'disliked_before' => $item->likes()->whereStatus(LikeStatus::DISLIKE)->whereUser(auth('api')->id())->first() ? true : false,
//                    'replies_count' => count($item->replies),
//                    'replies' => self::commentReplies($item->replies),
//                    'replies' => self::commentReplies($model->comments()->where('parent_id' , $item->id)->where('status' , CommentStatus::APPROVED)->get() , $model),
                    'createdAt' => $item->jCreated,
                    'updatedAt' => $item->jUpdated
                ];
            }
            return $data;
        } catch (\Exception $e) {
            return Rest::error($e);
        }

    }

//    public static function stories($items)
//    {
//        $data = [];
//        try {
//            foreach ($items as $item) {
//                $data[] = [
//                    'uuid' => $item->uuid,
//                    'username' => $item->user()->first()->username,
//                    'file' => Rest::tempUrl($item->file),
//                    'createdAt' => $item->jCreated,
//                    'updatedAt' => $item->jUpdated
//                ];
//            }
//
//            return $data;
//        } catch (\Exception $e) {
//            return Rest::error($e);
//        }
//    }

    public static function stories($items)
    {
        $data = [];
        try {
            foreach ($items as $item) {
                if ($item->id != auth('api')->id()) {
                    $data[] = [
                        'username' => $item->username,
                        'user_uuid' => $item->uuid,
                        'avatar' => Rest::tempUrl($item->avatar),
                        'story_count' => count($item->stories),
                        'stories' => self::storiesForUser($item->stories)
                    ];
                }
            }

            return $data;
        } catch (\Exception $e) {
            return Rest::error($e);
        }
    }

    public static function story($item)
    {
        try {
            return [
                'username' => $item->username,
                'user_uuid' => $item->uuid,
                'avatar' => Rest::tempUrl($item->avatar),
                'story_count' => count($item->stories),
                'stories' => self::storiesForUser($item->stories)
            ];
        } catch (\Exception $e) {
            return Rest::error($e);
        }
    }

    public static function storiesForUser($items)
    {
        $data = [];
        try {
            foreach ($items as $item) {
                $data[] = [
                    'uuid' => $item->uuid,
                    'file' => Rest::tempUrl($item->file),
                    'views' => $item->visits->count(),
                    'likes' => $item->likes->count(),
                    'liked_before' => $item->likes()->whereUser(auth('api')->id())->first() ? 'true' : 'false',
                    'visit_before' => $item->visits()->whereUser(auth('api')->id())->first() ? 'true' : 'false',
                    'createdAt' => $item->jCreated,
                    'updatedAt' => $item->jUpdated
                ];
            }

            return $data;
        } catch (\Exception $e) {
            return Rest::error($e);
        }
    }

    public static function events($items)
    {
        $data = [];
        try {
            foreach ($items as $item) {
                $data[] = [
                    'uuid' => $item->uuid,
                    'from' => $item->from,
                    'till' => $item->till,
                    'location' => $item->location,
                    'title' => $item->title,
                    'introduction' => $item->introduction,
                    'cover' => Rest::tempUrl($item->cover),
                    'contributor' => $item->contributor,
                    'address' => $item->address,
                    'latitude' => $item->latitude,
                    'longitude' => $item->longitude,
                    'live' => $item->live,
                    'video' => $item->video,
                    'dedicated' => $item->dedicated,
                    'private' => $item->private,
                    'type' => $item->type,
                    'status' => $item->status,
                    'username' => $item->user()->first()->username,
                    'speakers' => self::speackers($item->speakers),
                    'price' => $item->prices()->latest()->first() !== null ? $item->prices()->latest()->first()->price : null,
                    'categories' => self::categories($item->categories),
                    'tags' => self::tags($item->tags),
                    'createdAt' => $item->jCreated,
                    'updatedAt' => $item->jUpdated
                ];
            }

            return $data;
        } catch (\Exception $e) {
            return Rest::error($e);
        }
    }

    public static function speackers($items)
    {
        $data = [];
        try {
            foreach ($items as $item) {
                $data[] = [
                    'uuid' => $item->uuid,
                    'name' => $item->name,
                    'avatar' => Rest::tempUrl($item->avatar),
                    'bio' => $item->bio,
                    'website' => $item->website,
                    'instagram' => $item->instagram,
                    'telegram' => $item->telegram,
                    'createdAt' => $item->jCreated,
                    'updatedAt' => $item->jUpdated
                ];
            }

            return $data;
        } catch (\Exception $e) {
            return Rest::error($e);
        }
    }

    public static function eventsRelated($items , $uuid)
    {
        $data = [];
        try {
            foreach ($items->events as $item) {
                if ($item->uuid !== $uuid) {
                    $data[] = [
                        'uuid' => $item->uuid,
                        'from' => $item->from,
                        'till' => $item->till,
                        'location' => $item->location,
                        'title' => $item->title,
                        'introduction' => $item->introduction,
                        'cover' => $item->cover,
                        'contributor' => $item->contributor,
                        'address' => $item->address,
                        'latitude' => $item->latitude,
                        'longitude' => $item->longitude,
                        'live' => $item->live,
                        'video' => $item->video,
                        'dedicated' => $item->dedicated,
                        'private' => $item->private,
                        'type' => $item->type,
                        'status' => $item->status,
                        'speakers' => self::speackers($item->speakers),
                        'price' => $item->prices()->latest()->first() !== null ? $item->prices()->latest()->first()->price : null,
                        'categories' => self::categories($item->categories),
                        'tags' => self::tags($item->tags),
                        'createdAt' => $item->jCreated,
                        'updatedAt' => $item->jUpdated
                    ];
                }
            }

            return $data;
        } catch (\Exception $e) {
            return Rest::error($e);
        }
    }
}