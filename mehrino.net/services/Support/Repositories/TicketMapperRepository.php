<?php


namespace Services\Support\Repositories;


use Services\Support\Enum\Status;
use Services\User\Models\User as Account;

class TicketMapperRepository implements ITicketMapperRepository
{
    public function listTicket($tickets): array
    {
        $items = [];
        try {
            foreach ($tickets as $ticket) {
                $items[] = [
                    'uuid' => $ticket->uuid,
                    'title' => $ticket->title,
                    'priority' => priority_to_str($ticket->priority),
                    'message' => $ticket->message,
                    'department' => $ticket->department,
                    'status' => $ticket->status,
//                    'replies' => $ticket->replies ? $this->replies($ticket->replies) : null,
//                    'attachment' => $ticket->attachments ? $this->attachments($ticket->attachments) : null,
                    'createdAt' => $ticket->created_at
                ];
            }
        } catch (\Exception $exp) {
            notifyException($exp);
        }

        return $items;
    }

    private function replies($replies)
    {
        $items = [];
        try {
            foreach ($replies as $reply) {
                $items[] = [
                    'uuid' => $reply->uuid,
                    'replies' => $reply->replies ? $this->replies($reply->replies) : null,
                    'user' => $reply->user ? $this->account($reply->my) : null,
                    'message' => $reply->message,
                    'attachment' => $reply->attachments ? $this->attachments($reply->attachments) : null,
                    'createdAt' => $reply->created_at,
                ];
            }
        } catch (\Exception $e) {
            notifyException($e);
        }
        return $items;
    }

    private function attachments($attachments)
    {
        try {
            return $attachments ? getBaseUri($attachments->first()->path) : null;
        } catch (\Exception $e) {
            notifyException($e);
        }
        return "";
    }

    private function account($account): array
    {
        return [
            'uuid' => $account->uuid,
            'name' => $account->name,
            'avatar' => $account->avatar === null ? null : getBaseUri($account->avatar)
        ];
    }

    public function store(array $data): array
    {
        return [
            'user' => auth('api')->id(),
            'title' => $data['title'],
            'priority' => str_to_priority($data['priority']),
            'message' => $data['message'],
            'department' => in_array('department', $data) ? $data['department'] != null ? $data['department'] : 0 : 0,
            'status' => Status::Waiting
        ];
    }

    public function show($ticket): ?array
    {
        try {
            return [
                'uuid' => $ticket->uuid,
                'title' => $ticket->title,
                'priority' => priority_to_str($ticket->priority),
                'message' => $ticket->message,
                'department' => $ticket->department,
                'status' => $ticket->status,
                'replies' => $ticket->replies ? $this->replies($ticket->replies) : null,
//                'attachment' => $ticket->attachments ? $this->attachments($ticket->attachments) : null,
                'createdAt' => $ticket->created_at,
                'updatedAt' => $ticket->updated_at
            ];
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }

    public function reply($ticket, $msg, $reply = null): array
    {
        return [
            'ticket' => $ticket->id,
            'user' => auth('api')->id(),
            'message' => $msg,
            'reply' => $reply,
        ];
    }

}
