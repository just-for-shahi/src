<?php

namespace Services\Wall\Repositories;

use App\Models\WallRequests;
use Carbon\Carbon;
use App\Repository\Repository;

/**
 * Wall
 * @author Sajadweb
 * Fri Dec 25 2020 02:44:18 GMT+0330 (Iran Standard Time)
 */
class WallRequestRepository extends Repository implements IWallRequestRepository
{
      /**
     * The model being queried.
     *
     * @var WallRequests
     */
    public $model;
    public function __construct(WallRequests $model)
    {
        $this->model = new $model();
    }

    /**
     * @param array $data
     * @return bool
     */
    public function store($data)
    {
        try {
            $result = $this->model->create([
                'user' => auth()->user()->id,
                'wall_post'=> $data["wallPost"],
                'reject'=> $data["reject"],
                'status' => 1
            ]);
            return !empty($result) === true;
        } catch (\Exception $exp) {
            dd($exp);
            return false;
        }
    }

    /**
     * @param array $where
     * @param string[] $select
     * @param array $paginate
     * @return mixed
     */
    public function findMany($where, $select = ["*"], $paginate )
    {
        try {
            return $this->model->
            where($where)
                ->select($select)
                ->paginate($paginate["count"], '*', 'page', $paginate["page"]);
        } catch (\Exception $exp) {
            dd($exp);
        }
    }

    /**
     * @param $uuid
     * @return mixed
     */
    public function show($uuid)
    {
        try {
            $select = [
                'uuid',
                'status',
                'created_at as createdAt',
                'updated_at as updatedAt',
                'user',
                'wall_post as wallPost',
                'reject'
            ];
            return $this->model->where('uuid', $uuid)
                ->select($select)
                ->first();
        } catch (\Exception $exp) {
            dd($exp);
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
                'wall_post'=> $data["wallPost"],
                'reject'=> $data["reject"],
                'status' => $data["status"] ?? 1
            ]);
        } catch (\Exception $exp) {
            dd($exp);
            return false;
        }
    }


    public function destroy($uuid)
    {
        try {
            /*********** Soft Delete **********/
            return $this->model->
            where([
                'user' => auth()->user()->id,
                'uuid' => $uuid
            ])->update([
                'deleted_at' => Carbon::now()
            ]);
        } catch (\Exception $exp) {
            dd($exp);
            return false;
        }
    }
}
