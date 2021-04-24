<?php

namespace Services\Voluntary\Repositories;

use Illuminate\Support\Facades\DB;
use Services\Institute\Response\ResInstitute;
use Services\Voluntary\Models\VoluntaryWork;
use Carbon\Carbon;
use App\Repository\Repository;
use Services\Attachment\Repositories\IAttachmentRepository as IARepository;

/**
 * Voluntary
 * @author NimaDeve
 * Sun Dec 27 2020 14:01:39 GMT+0330 (Iran Standard Time)
 */
class VoluntaryWorkRepository extends Repository implements IVoluntaryWorkRepository
{
    /**
     * The model being queried.
     *
     * @var VoluntaryWork
     */
    public $model;
    public $attachment;


    public function __construct(VoluntaryWork $model, IARepository $attachment)
    {
        $this->model = new $model();
        $this->attachment = $attachment;
    }

    public function preAction($request, $institute)
    {

        $parse_from = Carbon::parse($request->date);
        $request->merge([
            'institutes' => $institute ? $institute->id : null,
            'from' => $parse_from->startOfDay()->toDateString(),
            'till' => $parse_from->addMonthNoOverflow($request->period)->startOfDay()->toDateString()
        ]);
        $data = $request->all();
        $data = [
            'user' => auth()->user()->id,
            'institutes' => isset($data["institutes"]) ? $data["institutes"] : null,
            'title' => isset($data["title"]) ? $data["title"] : null,
            'target_audience' => isset($data["audience"]) ? $data["audience"] : '',
            'period' => isset($data["period"]) ? $data["period"] : 0,
            'language' => isset($data["language"]) ? $data["language"] : null,
            'location' => isset($data["location"]) ? $data["location"] : null,
            'latitude' => $data["latitude"],
            'longitude' => $data["longitude"],
            'address' => isset($data["address"]) ? $data["address"] : null,
            'capacity' => isset($data["capacity"]) ? $data["capacity"] : 1,
            'description' => isset($data["description"]) ? $data["description"] : null,
            'from' => $data["from"],
            'till' => $data["till"],
            'cover' => $request->file('cover')->store(uploadPath("voluntaries/cover/" . auth()->user()->uuid)),
            'status' => config('mehrino.default_status.store'),
        ];
        $data['cover'] && imageOnQueue($data['cover']);
        if ($request->has('galleries') && !empty($request->input('galleries'))) {
            $data['galleries']=$request->input('galleries');
        }

        return $data;
    }

    public function store($data)
    {
        $result = $this->model->create($data);
        if (!$result) return false;

        if (collect($data)->has('galleries')) {
            $galleries = $data['galleries'];
            $this->attachment->db()
            ->whereIn('uuid',  $galleries)
            ->me()
            ->update([
                'attachable_type'=> VoluntaryWork::class,
                'attachable_id'=>  $result->id,
            ]);
        }

        $result->saveStatus(auth()->id(), config('mehrino.default_status.store'));

        return true;
    }

    public function search(array $where, array $paginate)
    {
        $select = [
            'uuid',
            'created_at as createdAt',
            'institutes',
            'user',
            'title',
            'activity',
            'target_audience as audience',
            'period',
            'latitude',
            'longitude',
            'capacity',
            'from',
            'till',
            'cover'
        ];
        return $this->model
            ->where($where)
            ->whereStatus(config('mehrino.default_status.show'))
            ->with(['institutes', 'isLike', 'isBookmark', 'user'])
            ->select($select)
            ->paginate($paginate["count"], '*', 'page', $paginate["page"]);
    }

    public function show($uuid)
    {
        $voluntary = $this->model
            ->where('uuid', $uuid)
            ->whereStatus(config('mehrino.default_status.show'))
            ->with(['institutes', 'attachments', 'isLike', 'isBookmark', 'user', 'visit', 'isBookmark'])
            ->first();
        if (!$voluntary)
            return null;
        return [
            'uuid' => $voluntary->uuid,
            'createdAt' => $voluntary->createdAt,
            'updatedAt' => $voluntary->updatedAt,
            'institutes' => instituteMap($voluntary->institutes()->first()),
            'user' => userMap($voluntary->user()->first()),
            'title' => $voluntary->title,
            'activity' => $voluntary->activity,
            'audience' => $voluntary->target_audience,
            'period' => $voluntary->period,
            'language' => $voluntary->language,
            'location' => $voluntary->location,
            'latitude' => $voluntary->latitude,
            'longitude' => $voluntary->longitude,
            'address' => $voluntary->address,
            'capacity' => $voluntary->capacity,
            'description' => $voluntary->description,
            'from' => $voluntary->from,
            'till' => $voluntary->till,
            'is_like' => !(!$voluntary->isLike),
            'visit' => !(!$voluntary->visit),
            'is_bookmark' => !(!$voluntary->isBookmark),
            'comments' => $voluntary->comments()->count(),
            'visits' => $voluntary->visit()->count(),
            'likes' => $voluntary->likes()->count(),
            'galleries' => attachMap($voluntary->attachments),
            'cover' => getBaseUri($voluntary->cover)
        ];
    }

    public function findUUID($uuid)
    {
        return $this->model
            ->where('uuid', $uuid)
            ->first();
    }


    public function updated($uuid, $request)
    {
        $data = [];
        $result = $this->model
            ->where([
                'user' => auth()->user()->id,
                'uuid' => $uuid
            ])
            ->first();
        if (!$result) return null;
        if ($request->has('date')) {
            $parse_from = Carbon::parse($request->date);
            $request->merge([
                'from' => $parse_from->startOfDay()->toDateString(),
                'till' => $parse_from->addMonthNoOverflow($request->period)->startOfDay()->toDateString()
            ]);
        }
        if ($request->has('title')) {
            $data['title'] = $request->input('title');
        }
        if ($request->has('institutes')) {
            $institute = $this->institute->findUUID($request->institutes);
            if (!$institute) return null;
            $data['title'] = $institute->id;
        }
        if ($request->has('audience')) {
            $data['target_audience'] = $request->input('audience');
        }
        if ($request->has('period')) {
            $data['period'] = $request->input('period');
        }
        if ($request->has('language')) {
            $data['language'] = $request->input('language');
        }
        if ($request->has('location')) {
            $data['location'] = $request->input('location');
        }
        if ($request->has('latitude')) {
            $data['latitude'] = $request->input('latitude');
        }
        if ($request->has('longitude')) {
            $data['longitude'] = $request->input('longitude');
        }
        if ($request->has('address')) {
            $data['address'] = $request->input('address');
        }
        if ($request->has('capacity')) {
            $data['capacity'] = $request->input('capacity');
        }
        if ($request->has('description')) {
            $data['description'] = $request->input('description');
        }
        if ($request->has('till')) {
            $data['till'] = $request->input('till');
        }
        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store(uploadPath("voluntaries/cover/" . auth()->user()->uuid));
            imageOnQueue($data['cover']);
            deleteAll($result->cover);
        }

        if ($request->has('galleries')) {
            $galleries = collect($request->input('galleries'));
                $this->attachment->db()
                ->whereIn('uuid',  $galleries)
                ->me()
                ->update([
                    'attachable_type'=> VoluntaryWork::class,
                    'attachable_id'=> $result->id,
                ]);
        }
        if (count($data) > 0) {
            $result = $result->update($data);
            if (empty($result)) return null;
        }
        return $result;
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

    public function mapper($res)
    {
        $data = [];
        foreach ($res as $item) {
            $r = collect($item);
            $r['cover'] = getBaseUri($r['cover']);
            $r['is_like'] = !(!$item->isLike);
            $r['visit'] = !(!$item->visit);
            $r['is_bookmark'] = !(!$item->isBookmark);
            $r['user'] = userMap($item->user()->first());
            $r['institutes'] = instituteMap($item->institutes()->first());
            $data[] = $r;
        }
        return $data;
    }
}
