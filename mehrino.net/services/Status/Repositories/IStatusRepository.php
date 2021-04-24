<?php

namespace Services\Status\Repositories;

use Services\Status\Models\Status;
use App\Repository\IRepository;

/**
 * Status
 * @author Sajadweb
 * Sat Jan 09 2021 19:57:43 GMT+0330 (Iran Standard Time)
 */
interface IStatusRepository extends IRepository
{
    public function paginate(int $count = 15, int $page = 1, array $columns = ['*']);

    public function paginateUser($uuid, int $count = 15, int $page = 1, array $columns = ['*']);

    public function paginateInstitute($uuid, int $count = 15, int $page = 1, array $columns = ['*']);

    public function mapper($results);

}
