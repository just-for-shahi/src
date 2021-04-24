<?php

namespace Services\Setting\Repositories;

use Services\Setting\Models\Setting;
use App\Repository\Repository;

/**
 * Setting
 * @author Sajadweb
 * Fri Dec 25 2020 02:40:53 GMT+0330 (Iran Standard Time)
 */
class SettingRepository extends Repository implements ISettingRepository
{
      /**
     * The model being queried.
     *
     * @var Setting
     */
    public $model;
    public function __construct(Setting $model)
    {
        $this->model = new $model();
    }

    public function add($user_id) {
        $this->model->user = $user_id;
        $this->model->save();
        return array_fill_keys($this->model->getFillable(), 0);
    }

    public function up($user, $data) {
        $setting = $user->setting;
        foreach($this->model->getFillable() as $coulmn) {
            if (isset($data[$coulmn])) {
                $setting->{$coulmn} = $data[$coulmn];
            }
        }
        return $setting->save();
    }
}
