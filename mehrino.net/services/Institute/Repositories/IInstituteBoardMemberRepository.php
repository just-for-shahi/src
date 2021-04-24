<?php
namespace Services\Institute\Repositories;

use Services\Institute\Models\Institute;
use App\Repository\IRepository;

/**
 * InstituteBoardMember
 * @author Sajadweb
 * Thu Dec 24 2020 01:00:04 GMT+0330 (Iran Standard Time)
 */
interface IInstituteBoardMemberRepository extends IRepository
{
    public function insert(array $data);
    public function updateAndInsert($request, $uuid);
}
