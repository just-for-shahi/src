<?php

namespace Services\Institute\Repositories;


use App\Repository\Repository;
use Illuminate\Support\Facades\DB;
use Services\Institute\Models\InstituteBranch;
use Services\Institute\Requests\InstituteRequest;

/**
 * Branch
 * @author Sajadweb
 * Thu Dec 24 2020 00:58:06 GMT+0330 (Iran Standard Time)
 */
class BranchRepository extends Repository implements IBranchRepository
{
    /**
     * The model being queried.
     *
     * @var InstituteBranch
     */
    public $model;

    public function __construct(InstituteBranch $model)
    {
        $this->model = new $model();
    }

    public function insert(array $data)
    {
        return $this->model->insert($data);
    }

    public function updateAndInsert($request, $institutes)
    {
        DB::transaction(function () use ($request, $institutes) {
            $len = collect($request->branch)->count();
            for ($i = 0; $i < $len; $i++) {
                if ($request->has("branch.$i.uuid")) {
                    $data = [];
                    $branch = ['title', 'instagram', 'telegram', 'aparat', 'whatsapp', 'phone', 'address', 'manager'];
                    foreach ($branch as $key) {
                        if ($request->has("branch.$i.$key", null)) {
                            $data[$key] = $request->input("branch.$i.$key");
                        }
                    }

                    if ($request->has("branch.$i.work_hours")) {
                        $find = $this->db()->where('uuid', $request->input("branch.$i.uuid"))->first();
                        $find->work_hours()->update($this->preBranchWorkHoursStore($request, $i));
                    }
                    $this->update([
                        'institutes' => $institutes->id,
                        'uuid' => $request->input("branch.$i.uuid")
                    ], $data);
                } else {
                    $insert = [
                        "uuid" => uuid(),
                        'created_at' => now(),
                        'updated_at' => now(),
                        'institutes' => $institutes->id,
                        'title' => $request->input("branch.$i.title", null),
                        'work_hours' => $this->preBranchWorkHoursStore($request, $i),
                        'instagram' => $request->input("branch.$i.instagram", null),
                        'telegram' => $request->input("branch.$i.telegram", null),
                        'aparat' => $request->input("branch.$i.aparat", null),
                        'whatsapp' => $request->input("branch.$i.whatsapp", null),
                        'phone' => $request->input("branch.$i.phone", null),
                        'address' => $request->input("branch.$i.address", null),
                        'manager' => $request->input("branch.$i.manager", 0)
                    ];
                    $model = $this->store($insert);

                    if ($model) {
                        if ($request->has("branch.$i.work_hours"))
                            $model->work_hours()->create($insert['work_hours']);
                    }
                }
            }
        });
    }

    public function preBranchWorkHoursStore($request, $i)
    {
        $data = [];
        if ($request->has("branch." . $i . '.work_hours.saturday_start'))
            $data['saturday_start'] = $request->input("branch." . $i . '.work_hours.saturday_start', null);
        if ($request->has("branch." . $i . '.work_hours.saturday_end'))
            $data['saturday_end'] = $request->input("branch." . $i . '.work_hours.saturday_end', null);
        if ($request->has("branch." . $i . '.work_hours.sunday_start'))
            $data['sunday_start'] = $request->input("branch." . $i . '.work_hours.sunday_start', null);
        if ($request->has("branch." . $i . '.work_hours.sunday_end'))
            $data['sunday_end'] = $request->input("branch." . $i . '.work_hours.sunday_end', null);
        if ($request->has("branch." . $i . '.work_hours.monday_start'))
            $data['monday_start'] = $request->input("branch." . $i . '.work_hours.monday_start', null);
        if ($request->has("branch." . $i . '.work_hours.monday_end'))
            $data['monday_end'] = $request->input("branch." . $i . '.work_hours.monday_end', null);
        if ($request->has("branch." . $i . '.work_hours.tuesday_start'))
            $data['tuesday_start'] = $request->input("branch." . $i . '.work_hours.tuesday_start', null);
        if ($request->has("branch." . $i . '.work_hours.tuesday_end'))
            $data['tuesday_end'] = $request->input("branch." . $i . '.work_hours.tuesday_end', null);
        if ($request->has("branch." . $i . '.work_hours.wednesday_start'))
            $data['wednesday_start'] = $request->input("branch." . $i . '.work_hours.wednesday_start', null);
        if ($request->has("branch." . $i . '.work_hours.wednesday_end'))
            $data['wednesday_end'] = $request->input("branch." . $i . '.work_hours.wednesday_end', null);
        if ($request->has("branch." . $i . '.work_hours.thursday_start'))
            $data['thursday_start'] = $request->input("branch." . $i . '.work_hours.thursday_start', null);
        if ($request->has("branch." . $i . '.work_hours.thursday_end'))
            $data['thursday_end'] = $request->input("branch." . $i . '.work_hours.thursday_end', null);
        if ($request->has("branch." . $i . '.work_hours.friday_start'))
            $data['friday_start'] = $request->input("branch." . $i . '.work_hours.friday_start', null);
        if ($request->has("branch." . $i . '.work_hours.friday_end'))
            $data['friday_end'] = $request->input("branch." . $i . '.work_hours.friday_end', null);
        return $data;
    }
}
