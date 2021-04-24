<?php

namespace Services\Institute\Repositories;

use Services\Institute\Models\InstituteWorkHours;
use App\Repository\Repository;

/**
 * InstituteWorkHours
 * @author Sajadweb
 * Thu Dec 24 2020 01:02:18 GMT+0330 (Iran Standard Time)
 */
class InstituteWorkHoursRepository extends Repository implements IInstituteWorkHoursRepository
{
    /**
     * The model being queried.
     *
     * @var InstituteWorkHours
     */
    public $model;

    public function __construct(InstituteWorkHours $model)
    {
        $this->model = new $model();
    }

    public function insert(array $data)
    {
        return $this->model->insert($data);
    }

    public function updateAndInsert($request, $institutes)
    {
     $work_hours = [
            'saturday_start',
            'saturday_end',
            'sunday_start',
            'sunday_end',
            'monday_start',
            'monday_end',
            'tuesday_start',
            'tuesday_end',
            'wednesday_start',
            'wednesday_end',
            'thursday_start',
            'thursday_end',
            'friday_start',
            'friday_end'
        ];
        $insert = [];
        foreach ($work_hours as $key) {
            if ($request->has("work_hours.$key")) {
                if ($institutes->work_hours) {
                    $institutes->work_hours->{$key} = $request->input("work_hours.$key",null);
                } else {
                    $insert[$key] = $request->input("work_hours.$key",null);
                }
            }
        }

        if ($institutes->work_hours) {
            return $institutes->work_hours->save();
        } else {
            return $institutes->work_hours()->create($insert);
        }
    }
}
