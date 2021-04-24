<?php

namespace Services\Institute\Repositories;

use Services\Institute\Models\InstituteWorkHours;
use App\Repository\IRepository;

/**
 * InstituteWorkHours
 * @author Sajadweb
 * Thu Dec 24 2020 01:02:18 GMT+0330 (Iran Standard Time)
 */
interface IInstituteWorkHoursRepository extends IRepository
{
    public function insert(array $data);

    public function updateAndInsert($request, $institutes);

}
