<?php
namespace Services\Donate\Repositories;

use Services\Donate\Models\Donate;
use App\Repository\IRepository;

/**
 * Donate
 * @author Sajadweb
 * Fri Dec 25 2020 02:38:30 GMT+0330 (Iran Standard Time)
 */
interface IDonateRepository extends IRepository
{
    public function storeDonate($request);
}
