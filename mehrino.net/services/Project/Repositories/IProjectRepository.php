<?php

namespace Services\Project\Repositories;

use Services\Project\Models\Project;
use App\Repository\IRepository;
use Services\Project\Requests\StoreProjectRequest;
use Services\Project\Requests\UpdateProjectRequest;

/**
 * Project
 * @author Sajadweb
 * Mon Dec 21 2020 17:35:28 GMT+0330 (Iran Standard Time)
 */
interface IProjectRepository extends IRepository
{
    public function mapper($res);

    public function preStore(StoreProjectRequest $request, $institutes);

    public function updated($uuid, $request);

    public function paginate(int $count = 15, int $page = 1, array $columns = ['*']);

    public function myPaginate(int $count = 15, int $page = 1, array $columns = ['*']);

    public function paginateWithInstitute(int $institutes_id, int $count = 15, int $page = 1, array $columns = ['*']);

    public function store(array $data);

    public function show($uuid);
    public function findUuid($uuid);

}
