<?php
namespace Services\Institute\Repositories;

use Services\Institute\Models\Institute;
use App\Repository\IRepository;
use Services\Institute\Requests\InstituteRequest;
use Services\Institute\Requests\UpdateInstituteRequest;

/**
 * Institute
 * @author Sajadweb
 * Mon Dec 21 2020 14:19:14 GMT+0330 (Iran Standard Time)
 */
interface IInstituteRepository extends IRepository
{
    public function paginate(int $count=15,int $page= 1,array $columns= ['*']);
    public function show($uuid);
    public function findUUID($uuid);
    public function update(array $where,array $data);
    public function mapper($res);
    public function preUpdate(UpdateInstituteRequest $request);
    public function preStore(InstituteRequest $request);
    public function preBranchStore(InstituteRequest $request, $institutes,IBranchRepository $repo_branch);
    public function preWorkHoursStore(InstituteRequest $request, $institutes);
    public function preBoardMemberStore(InstituteRequest $request, $institutes);
    public function insert(array $data);
}
