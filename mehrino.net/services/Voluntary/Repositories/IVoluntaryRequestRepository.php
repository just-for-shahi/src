<?php

namespace Services\Voluntary\Repositories;

use Services\Voluntary\Models\Voluntary;
use App\Repository\IRepository;

/**
 * Voluntary
 * @author Sajadweb
 * Sun Dec 27 2020 14:01:39 GMT+0330 (Iran Standard Time)
 */
interface IVoluntaryRequestRepository extends IRepository
{
    public function preAction($request, $voluntary);

    public function activityInc($voluntary);

    public function search(array $where, array $paginate);

    public function mapper($result);

    public function show($uuid);

    public function update($uuid, $data);

    public function reject($uuid);

    public function destroy($uuid);
}
