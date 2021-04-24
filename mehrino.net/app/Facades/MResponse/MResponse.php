<?php


namespace App\Facades\MResponse;


use App\Facades\Rest\Rest;
use App\Models\User;
use App\Support\Ticket;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;

class MResponse
{
    /**
     * @param $tags
     * @return array
     */
    public static function tags($tags){
        $items = [];
        try{
            foreach ($tags as $tag){
                $items[] = [
                    'uuid' => $tag->uuid,
                    'title' => $tag->name,
                    'color' => $tag->color,
                    'photo' => Rest::tempUrl($tag->photo),
                    'createdAt' => $tag->jCreated,
                    'updatedAt' => $tag->jUpdated
                ];
            }
        }catch (\Exception $e){
            Bugsnag::notifyException($e);
        }
        return $items;
    }

    /**
     * @param $categories
     * @return array
     */
    public static function categories($categories){
        $items = [];
        try{
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
        }catch (\Exception $e){
            Bugsnag::notifyException($e);
        }
        return $items;
    }

    /**
     * @param $publishers
     * @return array
     */
    public static function publishers($publishers){
        $items = [];
        try{
            foreach ($publishers as $publisher) {
                $items[] = [
                    'uuid' => $publisher->uuid,
                    'title' => $publisher->name,
                    'createdAt' => $publisher->jCreated,
                    'updatedAt' => $publisher->jUpdated
                ];
            }
        }catch (\Exception $e){
            Bugsnag::notifyException($e);
        }
        return $items;
    }

    /**
     * @param $writers
     * @return array
     */
    public static function writers($writers){
        $items = [];
        try{
            foreach ($writers as $writer) {
                $items[] = [
                    'uuid' => $writer->uuid,
                    'title' => $writer->name,
                    'createdAt' => $writer->jCreated,
                    'updatedAt' => $writer->jUpdated
                ];
            }
        }catch (\Exception $e){
            Bugsnag::notifyException($e);
        }
        return $items;
    }

    public static function replies($replies){
        $items=[];
        try{
            foreach ($replies as $reply){

                $user=User::Find($reply->user);
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
        }catch (\Exception $e){
            Bugsnag::notifyException($e);
        }
        return $items;
    }

}
