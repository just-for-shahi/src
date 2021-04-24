<?php


namespace Services\Support\Repositories;


interface  ITicketMapperRepository
{
    public function listTicket($tickets): array;
    public function store(array $data): array;
    public function show($ticket): ?array;
    public function reply($ticket,$msg): array;
}
