<?php

namespace Services\Wall\Repositories;

use App\Repository\IRepository;

/**
 * Wall
 * @author Sajadweb
 * Fri Dec 25 2020 02:44:18 GMT+0330 (Iran Standard Time)
 */
interface IWallPostRepository extends IRepository
{
    public function findMany(array $where, array $columns, array $paginate);

    public function preAction($request, $institute, $wall);

    public function store(array $data);

    public function show($uuid);

    public function updated($uuid, $data);

    public function destroy($uuid);

    public function mapper($res);
}
