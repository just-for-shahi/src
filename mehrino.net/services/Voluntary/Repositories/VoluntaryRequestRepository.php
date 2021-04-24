<?php

namespace Services\Voluntary\Repositories;

use Services\Voluntary\Models\VoluntaryRequest;
use Carbon\Carbon;
use Services\Voluntary\Models\Voluntary;
use App\Repository\Repository;

/**
 * Voluntary
 * @author NimaDeve
 * Sun Dec 27 2020 14:01:39 GMT+0330 (Iran Standard Time)
 */
class VoluntaryRequestRepository extends Repository implements IVoluntaryRequestRepository
{
    /**
     * The model being queried.
     *
     * @var VoluntaryRequest
     */
    public $model;

    public function __construct(VoluntaryRequest $model)
    {
        $this->model = new $model();
    }


    public function preAction($request, $voluntary)
    {
        return [
            'user' => auth()->user()->id,
            'private' => boolToInt($request->input("private")),
            'voluntary_work' => $voluntary->id,
            'resume' => (string)$request
                ->file('resume')
                ->store(uploadPath("resume/" . auth()->user()->uuid)),
        ];
    }

    public function activityInc($voluntary)
    {
        return $voluntary->update([
            'activity' => (int)$voluntary->activity + 1
        ]);
    }

    public function search($where, $paginate)
    {
        return $this->model
            ->where($where)
            ->with(['user'])
//                ->where('status', 1)
            ->paginate($paginate["count"], '*', 'page', $paginate["page"]);
    }

    public function mapper($result)
    {
        $data = [];
        foreach ($result as $item) {
            $data[] = [
                'user' => userMap($item->user()->first()),
                'resume' => getBaseUri($item->resume),
                'reject' => !!$item->reject,
                'private' => $item->private,
                'createdAt' => $item->created_at,
                'uuid' => $item->uuid,
                'status' => $item->status,
            ];
        }
        return $data;
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
                'voluntary_work as voluntary',
                'resume',
                'reject',
                'private',
            ];
            return $this->model->where('uuid', $uuid)
                ->me()
                ->select($select)
                ->first();
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }


    public function update($uuid, $data)
    {
        try {
            return $this->model->where([
                'user' => auth()->user()->id,
                'uuid' => $uuid
            ])->update([
                'voluntary_work' => $data["voluntaryID"],
                'resume' => $data["resume"] ?? "",
            ]);
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }

    public function reject($uuid)
    {
        try {
            $request = $this->model->where([
                'user' => auth()->user()->id,
                'uuid' => $uuid,
            ])->first();

            if (!$request) return NotFound404();
            if ($request->reject === 1) return NotFound404();

            $result = $this->model->where([
                'user' => auth()->user()->id,
                'uuid' => $uuid
            ])->update([
                'reject' => 1,
            ]);

            if ($result) {
                $request->getVoluntaryWork()->update([
                    'activity' => $request->getVoluntaryWork->activity - 1
                ]);
                return true;
            }
            return false;
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
