<?php

namespace Services\Support\Repositories;

use Services\Support\Models\TicketReply;

/**
 * ReplayRepository
 * @author Sajadweb
 * 2020-06-06 09:50:47
 */
class ReplyRepository implements IReplyRepository
{
    /**
     * The model being queried.
     *
     * @var TicketReply
     */
    protected $model;

    public function __construct(TicketReply $model)
    {
        $this->model = $model::query();
    }

    public function store($data)
    {
        return $this->model->create($data);
    }

    public function findUuid($uuid)
    {
        return $this->model->me()->where('uuid',$uuid)->first();
    }
}
