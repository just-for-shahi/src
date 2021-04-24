<?php

namespace Services\Voluntary\Repositories;

use Services\Voluntary\Models\Voluntary;
use App\Repository\IRepository;

/**
 * Voluntary
 * @author Sajadweb
 * Sun Dec 27 2020 14:01:39 GMT+0330 (Iran Standard Time)
 */
interface IVoluntaryCertificateRepository extends IRepository
{
    public function findMany(array $where, array $columns, array $paginate);

    public function preAction($request, $voluntary);

    public function store(array $data);

    public function show($uuid);

    public function update($uuid, $data);

    public function destroy($uuid);
}
