<?php

namespace Services\Support\Repositories;

use Services\Support\Models\Ticket;

/**
 * TicketRepository
 * @author Sajadweb
 * 2020-06-06 09:50:47
 */
interface ITicketAccountRepository
{
    public function store(Ticket $ticket);
}
