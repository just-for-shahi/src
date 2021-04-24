<?php

namespace Services\Voluntary\Repositories;

use Services\Voluntary\Models\VoluntaryCertificate;
use Carbon\Carbon;
use Services\Voluntary\Models\Voluntary;
use App\Repository\Repository;

/**
 * Voluntary
 * @author NimaDeve
 * Sun Dec 27 2020 14:01:39 GMT+0330 (Iran Standard Time)
 */
class VoluntaryCertificateRepository extends Repository implements IVoluntaryCertificateRepository
{
    /**
     * The model being queried.
     *
     * @var VoluntaryCertificate
     */
    public $model;

    public function __construct(VoluntaryCertificate $model)
    {
        $this->model = new $model();
    }


    public function preAction($request, $voluntary)
    {
        $request->merge([
            'voluntary' => $voluntary->id,
        ]);
        return $request->all();
    }

    public function store($data)
    {
        try {
            $result = $this->model->create([
                'user' => auth()->user()->id,
                'voluntary_work' => $data["voluntary"],
                'certificate' =>  $data["certificate"],
            ]);
            return !empty($result) === true;
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }

    public function findMany($where, $paginate, $select = ["*"])
    {
        try {
            return $this->model->
            where($where)
                ->select($select)
                ->paginate($paginate["count"], '*', 'page', $paginate["page"]);
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }

    public function show($uuid)
    {
        try {
            $select = [
                'uuid',
                'status',
                'created_at as createdAt',
                'updated_at as updatedAt',
                'user',
                'voluntary_work',
                'certificate'
            ];
            return $this->model->where('uuid', $uuid)
                ->select($select)
                ->first();
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }


    public function update($uuid, $data)
    {
        try {
            return $this->model->
            where([
                'user' => auth()->user()->id,
                'uuid' => $uuid
            ])->update([
                'voluntary_work' => $data["voluntary"],
                'certificate' =>  $data["certificate"],
            ]);
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }

    public function destroy($uuid)
    {
        try {
            return $this->model
                ->where([
                    'user' => auth()->user()->id,
                    'uuid' => $uuid
                ])->delete();
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }
}
