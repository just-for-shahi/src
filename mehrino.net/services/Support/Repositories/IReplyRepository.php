<?php

namespace Services\Support\Repositories;

use Services\Support\Models\Ticket;
use Services\Support\Models\TicketAccount;

/**
 * TicketRepository
 * @author NimaDeve
 * 2020-06-06 09:50:47
 */
interface IReplyRepository
{
    public function store($data);
    public function findUuid($uuid);
}
