<?php

namespace Services\Voluntary\Repositories;

use Services\Voluntary\Models\Voluntary;
use App\Repository\IRepository;

/**
 * Voluntary
 * @author Sajadweb
 * Sun Dec 27 2020 14:01:39 GMT+0330 (Iran Standard Time)
 */
interface IVoluntaryWorkRepository extends IRepository
{
    public function search(array $where, array $paginate);

    public function mapper($result);

    public function preAction($request, $institute);

    public function store(array $data);

    public function show($uuid);

    public function findUUID($uuid);

    public function updated($uuid, $data);

    public function destroy($uuid);
}
