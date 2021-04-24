<?php
namespace Services\Institute\Repositories;

use Services\Institute\Models\Institute;
use App\Repository\IRepository;

/**
 * Branch
 * @author Sajadweb
 * Thu Dec 24 2020 00:58:06 GMT+0330 (Iran Standard Time)
 */
interface IBranchRepository extends IRepository
{
    public function insert(array $data);
    public function updateAndInsert($request, $uuid);

}
