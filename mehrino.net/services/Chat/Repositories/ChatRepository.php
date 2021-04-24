<?php

namespace Services\Chat\Repositories;

use Services\Chat\Models\Chat;
use App\Repository\Repository;
use Services\Chat\Models\ChatMessage;

/**
 * Chat
 * @author Sajadweb
 * Sun Dec 27 2020 13:55:03 GMT+0330 (Iran Standard Time)
 */
class ChatRepository extends Repository implements IChatRepository
{
    /**
     * The model being queried.
     *
     * @var Chat
     */
    public $model;
    public $message;

    public function __construct(Chat $model, ChatMessage $message)
    {
        $this->model = new $model();
        $this->message = new  $message();
    }

    public function mapper($chats)
    {
        $data = [];
        foreach ($chats as $chat) {
            $user = $chat->user()->first();
            $title = auth()->user()->uuid === $user->uuid ? $chat->title : ($user->name ?? $chat->title);
            $logo = auth()->user()->uuid === $user->uuid ? getBaseUri($chat->logo) : (getBaseUri($user->avatar) ?? getBaseUri($chat->logo));
            $data[] = [
                "uuid" => $chat->uuid,
                "title" => $title,
                "date" => $chat->created_at,
                "description" => $chat->description,
                "logo" =>  $logo,
                "not_seen" => 0,
                // TODO group
                "type" => 1,
                "online" => 0
            ];
        }
        return $data;
    }

    public function mapperChat($chats)
    {
        $data = [];
        foreach ($chats as $chat) {
            $data[] = [
                "uuid" => $chat['uuid'],
                "message" => strpos($chat['message'], 'chat/message') ? getBaseUri($chat['message']) : $chat['message'],
                "createdAt" => $chat['created_at'],
                "user" => userMap($chat->user()->first()),
                "status" => 1,
                "not_seen" => 0
            ];
        }
        return $data;
    }

    public function preStore($service)
    {
        $result = [
            'user' => auth()->id(),
            'type' => 0,
            'title' => isset($service->title) ? $service->title : 'chat',
            'description' => isset($service->title) ? $service->title : 'chat',
            'logo' => isset($service->cover) ? $service->cover : null,
            'username' => random_username(auth()->user()->name, auth()->user()->id)
        ];
        return $result;
    }

    public function findMany($where, $paginate, $select = ["*"])
    {
        try {
            $data = $this->model
                ->where($where)
                //                ->where('status', 1)
                ->has('chatable')
                ->with(['user', 'chatable'])
                ->latest()
                ->select($select)
                ->where('user', auth()->id())
                ->orWhereHas('chatable', function ($query) {
                    $query->where('user', auth()->id());
                })
                ->paginate($paginate["count"], '*', 'page', $paginate["page"]);

            return $data;
        } catch (\Exception $exp) {
            return InternalServerError500($exp);
        }
    }

    public function findManyChat($uuid, $paginate, $select = ["*"])
    {
        try {
            $chat = $this->model
                ->where('uuid', $uuid)
                // ->where('user', auth()->id())
                // ->orWhereHas('chatable', function ($query) {
                //     $query->where('user', auth()->id());
                // })
                ->first();
            if (!$chat) {
                httpThrow(NotFound404());
            }
            $data = $this->message
                ->where('chat', $chat->id)
                ->with('user')
                ->latest()
                ->paginate($paginate["count"], '*', 'page', $paginate["page"]);

            return $data;
        } catch (\Exception $exp) {
            return InternalServerError500($exp);
        }
    }

    public function storeChat($uuid, $request)
    {
        try {
             $chat = $this->model->where('uuid', $uuid)
                ->has('chatable')
                // ->where('user', auth()->id())
                // ->orWhereHas('chatable', function ($query) {
                //     $query->where('user', auth()->id());
                // })
             ->first();
            if (!$chat) {
                httpThrow(NotFound404());
            }
            $message = '';
            if ($request->hasFile('message')) {
                $message = $request->file('message')
                    ->store(uploadPath("chat/message/" . auth()->user()->uuid) . "/");
            } else if ($request->has('message')) {
                $message = $request->message;
            }
            return $this->message->create([
                'message' => $message,
                'chat' => $chat->id,
                'user' => auth()->id(),
            ]);
        } catch (\Exception $exp) {
            return InternalServerError500($exp);
        }
    }
}
