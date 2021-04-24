<?php

namespace Services\Wall\Repositories;

use Services\Wall\Models\Wall;
use App\Repository\IRepository;

/**
 * Wall
 * @author Sajadweb
 * Fri Dec 25 2020 02:44:18 GMT+0330 (Iran Standard Time)
 */
interface IWallRepository extends IRepository
{
    public function findMany(array $where, array $columns, array $paginate);

    public function mapper($data);

    public function store(array $data);

    public function show($uuid);

    public function update($uuid, $data);

    public function findUUID($uuid);

    public function destroy($uuid);

    public function paginate(int $count=15,int $page= 1,array $columns= ['*']);

}
