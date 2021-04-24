<?php

namespace Services\Institute\Repositories;

use Services\Institute\Enum\StatusInstitute;

use Services\Institute\Models\Institute;
use App\Repository\Repository;

use Services\Institute\Requests\InstituteRequest;
use Services\Institute\Requests\UpdateInstituteRequest;
use Services\Institute\Response\InstituteBoardMember;
use Services\Institute\Response\InstituteBranch;
use Services\Institute\Response\InstituteWorkHours;
use Services\Institute\Response\ResInstitute;
use Services\Institute\Response\Institute as ShowInstitute;

/**
 * Institute
 * @author Sajadweb
 * Mon Dec 21 2020 14:19:14 GMT+0330 (Iran Standard Time)
 */
class InstituteRepository extends Repository implements IInstituteRepository
{
    /**
     * The model being queried.
     *
     * @var Institute
     */
    public $model;

    public function __construct(Institute $model)
    {
        $this->model = new $model();
    }

    public function paginate(int $count = 15, int $page = 1, array $columns = ['*'])
    {
        return $this->model->me()
            ->orderBy('id', 'desc')
            ->paginate($count, $columns, null, $page);
    }

    public function preStore(InstituteRequest $request)
    {
        $logo = null;
        $statute_file = null;
        $license_file = null;
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo')->store(uploadPath("institute/" . auth()->user()->uuid) . "/");
            $logo && imageOnQueue($logo);
        }
        if ($request->hasFile('statute_file')) {
            $statute_file = $request->file('statute_file')->store(uploadPath("institute/" . auth()->user()->uuid . "/"));
        }
        if ($request->hasFile('license_file')) {
            $license_file = $request->file('license_file')->store(uploadPath("institute/" . auth()->user()->uuid . "/"));
        }
        return [
            'user' => auth()->user()->id,
            'title' => $request->title,
            'type' => $request->input('type', 0),
            'logo' => $logo,
            'website' => $request->input('website', null),
            'email' => $request->input('email', null),
            'linkedin' => $request->input('linkedin', null),
            'youtube' => $request->input('youtube', null),
            'instagram' => $request->input('instagram', null),
            'telegram' => $request->input('telegram', null),
            'aparat' => $request->input('aparat', null),
            'whatsapp' => $request->input('whatsapp', null),
            'phone' => $request->input('phone', null),
            'registered' => $request->input('registered', null),
            'created' => $request->input('created', null),
            'registered_no' => $request->registered_no,
            'registered_name' => $request->input('registered_name', null),
            'license_no' => $request->license_no,
            'license_expire' => $request->input('license_expire', null),
            'license_provider' => $request->input('license_provider', 0),
            'address' => $request->input('address', null),
            'statute' => $request->input('statute', 0),
            'activity_range' => $request->input('activity_range', 0),
            'ceo' => $request->input('ceo', null),
            'about' => $request->input('about', null),
            'license_file' => $license_file,
            'statute_file' => $statute_file,
            'status' => StatusInstitute::Waiting,
            'latitude' => $request->input('latitude', null),
            'longitude' => $request->input('longitude', null),
            'covered_persons' => $request->input('covered_persons', 0)
        ];
    }

    public function preBranchStore(InstituteRequest $request, $institutes, IBranchRepository $repo_branch)
    {

        $res = true;
        $len = collect($request->branch)->count();
        for ($i = 0; $i < $len; $i++) {
            $data = [
                "uuid" => uuid(),
                'created_at' => now(),
                'updated_at' => now(),
                'institutes' => $institutes->id,
                'work_hours' => $this->preBranchWorkHoursStore($request, $i),
                'title' => $request->input("branch.$i.title", null),
                'instagram' => $request->input("branch.$i.instagram", null),
                'telegram' => $request->input("branch.$i.telegram", null),
                'aparat' => $request->input("branch.$i.aparat", null),
                'whatsapp' => $request->input("branch.$i.whatsapp", null),
                'phone' => $request->input("branch.$i.phone", null),
                'address' => $request->input("branch.$i.address", null),
                'manager' => $request->input("branch.$i.manager", null)
            ];
            $model = $repo_branch->store($data);
            if ($model) {
                if ($request->has("branch.$i.work_hours"))
                    $model->work_hours()->create($data['work_hours']);
            } else {
                $res = false;
            }
        }

        return $res;
    }

    public function preBranchWorkHoursStore(InstituteRequest $request, $i)
    {
        return [
            'saturday_start' => $request->input("branch." . $i . '.work_hours.saturday_start', null),
            'saturday_end' => $request->input("branch." . $i . '.work_hours.saturday_end', null),
            'sunday_start' => $request->input("branch." . $i . '.work_hours.sunday_start', null),
            'sunday_end' => $request->input("branch." . $i . '.work_hours.sunday_end', null),
            'monday_start' => $request->input("branch." . $i . '.work_hours.monday_start', null),
            'monday_end' => $request->input("branch." . $i . '.work_hours.monday_end', null),
            'tuesday_start' => $request->input("branch." . $i . '.work_hours.tuesday_start', null),
            'tuesday_end' => $request->input("branch." . $i . '.work_hours.tuesday_end', null),
            'wednesday_start' => $request->input("branch." . $i . '.work_hours.wednesday_start', null),
            'wednesday_end' => $request->input("branch." . $i . '.work_hours.wednesday_end', null),
            'thursday_start' => $request->input("branch." . $i . '.work_hours.thursday_start', null),
            'thursday_end' => $request->input("branch." . $i . '.work_hours.thursday_end', null),
            'friday_start' => $request->input("branch." . $i . '.work_hours.friday_start', null),
            'friday_end' => $request->input("branch." . $i . '.work_hours.friday_end', null)
        ];
    }

    public function preWorkHoursStore(InstituteRequest $request, $institutes)
    {
        return [
            'institutes' => $institutes->id,
            'saturday_start' => $request->input('work_hours.saturday_start', null),
            'saturday_end' => $request->input('work_hours.saturday_end', null),
            'sunday_start' => $request->input('work_hours.sunday_start', null),
            'sunday_end' => $request->input('work_hours.sunday_end', null),
            'monday_start' => $request->input('work_hours.monday_start', null),
            'monday_end' => $request->input('work_hours.monday_end', null),
            'tuesday_start' => $request->input('work_hours.tuesday_start', null),
            'tuesday_end' => $request->input('work_hours.tuesday_end', null),
            'wednesday_start' => $request->input('work_hours.wednesday_start', null),
            'wednesday_end' => $request->input('work_hours.wednesday_end', null),
            'thursday_start' => $request->input('work_hours.thursday_start', null),
            'thursday_end' => $request->input('work_hours.thursday_end', null),
            'friday_start' => $request->input('work_hours.friday_start', null),
            'friday_end' => $request->input('work_hours.friday_end', null)
        ];
    }

    public function preBoardMemberStore(InstituteRequest $request, $institutes)
    {
        $data = [];
        $len = collect($request->board_member)->count();
        for ($i = 0; $i < $len; $i++) {
            $avatar = null;
            if ($request->hasFile("board_member.$i.avatar")) {
                $avatar = $request->file("board_member.$i.avatar")->store(uploadPath("institute/" . auth()->user()->uuid) . "/");
                $avatar && imageOnQueue($avatar);
            }
            $data[] = [
                "uuid" => uuid(),
                'created_at' => now(),
                'updated_at' => now(),
                'institutes' => $institutes->id,
                'name' => $request->input("board_member.$i.name"),
                'position' => $request->input("board_member.$i.position", null),
                'introduction' => $request->input("board_member.$i.introduction", null),
                'avatar' => $avatar,
                'website' => $request->input("board_member.$i.website", null),
                'instagram' => $request->input("board_member.$i.instagram", null),
                'telegram' => $request->input("board_member.$i.telegram", null),
                'aparat' => $request->input("board_member.$i.aparat", null),
                'linkedin' => $request->input("board_member.$i.linkedin", null)

            ];
        }
        return $data;
    }

    public function insert(array $data)
    {
        return $this->model->insert($data);
    }

    public function mapper($res)
    {
        $ins = new ResInstitute();
        $data = [];
        foreach ($res as $item) {
            $data[] = mapper($ins, $item, function ($r) {
                $r['logo'] = $r['logo'] != null ? getBaseUri($r['logo']) : null;
                return $r;
            });
        }
        return $data;
    }

    private function mapperBoardMember($res)
    {
        if (!$res) {
            return null;
        }
        $board_member = new InstituteBoardMember();
        $data = [];
        foreach ($res as $item) {
            $data[] = mapper($board_member, $item, function ($r) {
                return $r;
            });
        }
        return $data;
    }

    private function mapperBranch($res)
    {
        if (!$res) {
            return null;
        }
        $branch = new InstituteBranch();
        $data = [];
        foreach ($res as $item) {
            $data[] = mapper($branch, $item, function ($r) {
                $work_hours = new InstituteWorkHours();
                $r['work_hours'] = $r['work_hours'] != null ? mapper($work_hours, $r['work_hours'], null) : null;
                return $r;
            });
        }
        return $data;
    }

    public function findUUID($uuid)
    {
        return $this->model
            ->me()
            ->with(['branch', 'board_member', 'work_hours'])
            ->where('uuid', $uuid)
            ->first();
    }

    public function show($uuid)
    {
        $item = $this->model
            ->with(['branch', 'user', 'branch.work_hours', 'board_member', 'work_hours', 'isFollow'])
            ->where('uuid', $uuid)
            ->first();

        if (!$item) httpThrow(NotFound404());
        $ins = new ShowInstitute();
        return mapper($ins, $item, function ($r) use ($item) {
            $r['logo'] = $r['logo'] != null ? getBaseUri($r['logo']) : null;
            $r['license_file'] = $r['license_file'] != null ? getBaseUri($r['license_file']) : null;
            $r['statute_file'] = $r['statute_file'] != null ? getBaseUri($r['statute_file']) : null;
            $work_hours = new InstituteWorkHours();
            $r['work_hours'] = $r['work_hours'] != null ? mapper($work_hours, $r['work_hours'], null) : null;
            $r['branch'] = $this->mapperBranch($r['branch']);
            $r['board_member'] = $this->mapperBoardMember($r['board_member']);
            $r['user'] = $item->user()->first(['uuid', 'name']);
            $r['is_follow'] = !(!$item->isFollow);
            $r['posts'] = $item->projects()->count();
            $r['followers'] = $item->follows()->count();
            $r['user'] = $item->user()->first(['uuid', 'name']);
            return $r;
        });
    }

    public function update($where, array $data)
    {
        return $this->model->where($where)->update($data);
    }

    public function preUpdate(UpdateInstituteRequest $request)
    {
        $data = [];
        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store(uploadPath("institute/" . auth()->user()->uuid) . "/");
            $data['logo'] && imageOnQueue($data['logo']);
        }
        if ($request->hasFile('statute_file')) {
            $data['statute_file'] = $request->file('statute_file')->store(uploadPath("institute/" . auth()->user()->uuid . "/"));
        }
        if ($request->hasFile('license_file')) {
            $data['license_file'] = $request->file('license_file')->store(uploadPath("institute/" . auth()->user()->uuid . "/"));
        }
        if ($request->has('phone')) {
            $data['phone'] = $request->phone;
        }
        if ($request->has('whatsapp')) {
            $data['whatsapp'] = $request->whatsapp;
        }
        if ($request->has('aparat')) {
            $data['aparat'] = $request->aparat;
        }
        if ($request->has('telegram')) {
            $data['telegram'] = $request->telegram;
        }
        if ($request->has('instagram')) {
            $data['instagram'] = $request->instagram;
        }
        if ($request->has('youtube')) {
            $data['youtube'] = $request->youtube;
        }
        if ($request->has('linkedin')) {
            $data['linkedin'] = $request->linkedin;
        }
        if ($request->has('email')) {
            $data['email'] = $request->email;
        }
        if ($request->has('website')) {
            $data['website'] = $request->website;
        }
        if ($request->has('type')) {
            $data['type'] = $request->input('type');
        }
        if ($request->has('registered')) {
            $data['registered'] = $request->input('registered', null);
        }
        if ($request->has('created')) {
            $data['created'] = $request->input('created', null);
        }
        if ($request->has('registered_no')) {
            $data['registered_no'] = $request->registered_no;
        }
        if ($request->has('registered_name')) {
            $data['registered_name'] = $request->input('registered_name', null);
        }
        if ($request->has('license_no')) {
            $data['license_no'] = $request->license_no;
        }
        if ($request->has('license_expire')) {
            $data['license_expire'] = $request->input('license_expire', null);
        }
        if ($request->has('license_provider')) {
            $data['license_provider'] = $request->input('license_provider', 0);
        }
        if ($request->has('address')) {
            $data['address'] = $request->input('address', null);
        }
        if ($request->has('activity_range')) {
            $data['activity_range'] = $request->input('activity_range', 0);
        }
        if ($request->has('statute')) {
            $data['statute'] = $request->input('statute', 0);
        }
        if ($request->has('ceo')) {
            $data['ceo'] = $request->ceo;
        }
        if ($request->has('latitude')) {
            $data['latitude'] = $request->input('latitude', null);
        }
        if ($request->has('longitude')) {
            $data['longitude'] = $request->input('longitude', null);
        }
        if ($request->has('title')) {
            $data['title'] = $request->input('title', null);
        }
        if ($request->has('covered_persons')) {
            $data['covered_persons'] = $request->input('covered_persons', 0);
        }
        return $data;
    }
}
