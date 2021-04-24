<?php

namespace Services\Support\Repositories;

use Services\Support\Models\Ticket;
use Services\Support\Models\TicketUser;

/**
 * TicketRepository
 * @author Sajadweb
 * 2020-06-06 09:50:47
 */
class TicketAccountRepository implements ITicketAccountRepository
{
    /**
     * The model being queried.
     *
     * @var TicketUser
     */
    protected $model;

    public function __construct(TicketUser $model)
    {
        $this->model = $model::query();
    }

    public function store(Ticket $ticket)
    {
        return $this->model->create(["ticket" => $ticket->id, "user" => auth('api')->id()]);
    }
}
