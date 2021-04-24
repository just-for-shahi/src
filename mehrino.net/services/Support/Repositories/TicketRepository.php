<?php

namespace Services\Support\Repositories;

use Services\Support\Enum\Status;
use Services\Support\Models\Ticket;

/**
 * TicketRepository
 * @author Sajadweb
 * 2020-06-06 09:50:47
 */
class TicketRepository implements ITicketRepository
{
    /**
     * The model being queried.
     *
     * @var Ticket
     */
    protected $model;

    public function __construct(Ticket $model)
    {
        $this->model = $model::query();
    }

    public function paginate(int $count = 15, int $page = 1, array $columns = ['*'])
    {
        return $this->model
            ->has('my_ticket')
//            ->with(['replies', 'replies.replies', 'replies.my'])
            ->orderBy('id', 'desc')
            ->paginate($count, $columns, $pageName = null, $page);
    }

    public function store($data)
    {
        return $this->model->create($data);
    }

    public function show($uuid)
    {
        return $this->model
            ->has('my_ticket')
            ->with(['replies', 'replies.replies', 'replies.my'])
            ->where('uuid', $uuid)->first();
    }

    public function update($uuid, $data)
    {
        return $this->model
            ->has('my_ticket')
            ->where('uuid', $uuid)->update($data);
    }

    public function destroy($uuid)
    {
        return $this->model->where('uuid', $uuid)->delete();
    }
}
