<?php

namespace Services\Report\Repositories;

use Services\Report\Models\Report;
use App\Repository\IRepository;

/**
 * Report
 * @author Sajadweb
 * Mon Jan 11 2021 21:18:28 GMT+0330 (Iran Standard Time)
 */
interface IReportRepository extends IRepository
{
    public function saved($request, $service);
    public function mapper($res);
    public function paginateWithService($service, int $count = 15, int $page = 1, array $columns = ['*']);
}
