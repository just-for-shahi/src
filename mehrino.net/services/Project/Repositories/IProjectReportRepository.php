<?php
namespace Services\Project\Repositories;

use Services\Project\Models\Project;
use App\Repository\IRepository;

/**
 * ProjectReport
 * @author Sajadweb
 * Mon Jan 04 2021 03:21:07 GMT+0330 (Iran Standard Time)
 */
interface IProjectReportRepository extends IRepository
{
    public function saved($request,Project $project);
    public function mapper($res);
    public function paginateWithProject(int $project_id, int $count=15,int $page= 1,array $columns= ['*']);
}
