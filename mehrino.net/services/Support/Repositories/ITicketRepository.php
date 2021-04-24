<?php

namespace Services\Support\Repositories;

use Services\Support\Models\Ticket;

/**
 * TicketRepository
 * @author Sajadweb
 * 2020-06-06 09:50:47
 */
interface ITicketRepository
{
    public function paginate(int $count = 15, int $page = 1, array $columns = ['*']);

    public function store($data);

    public function show($uuid);

    public function update($uuid,$data);

    public function destroy($uuid);
}
