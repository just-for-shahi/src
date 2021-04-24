<?php
namespace Services\Setting\Repositories;

use Services\Setting\Models\Setting;
use App\Repository\IRepository;

/**
 * Setting
 * @author Sajadweb
 * Fri Dec 25 2020 02:40:53 GMT+0330 (Iran Standard Time)
 */
interface ISettingRepository extends IRepository
{
    public function add($user_id);
    public function up($user_id, $data);
}
