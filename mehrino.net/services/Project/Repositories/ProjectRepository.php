<?php

namespace Services\Project\Repositories;

use Illuminate\Support\Facades\DB;
use Services\Institute\Response\ResInstitute;
use Services\Project\Models\Project;
use App\Repository\Repository;
use Services\Attachment\Repositories\IAttachmentRepository;
use Services\Project\Requests\StoreProjectRequest;
use Services\Project\Requests\UpdateProjectRequest;
use Services\Project\Response\ResProject;
use Services\Project\Response\ResShowProject;

/**
 * Project
 * @author Sajadweb
 * Mon Dec 21 2020 17:35:28 GMT+0330 (Iran Standard Time)
 */
class ProjectRepository extends Repository implements IProjectRepository
{
    /**
     * The model being queried.
     *
     * @var Project
     */
    public $model;
    public $attachment;
    public $st_field = [
        'title' => "",
        'content' => null,
        'latitude' => null,
        'longitude' => null,
        'target' => 0,
        'current_balance' => 0,
        'collaborators' => 0
    ];
    public $up_field = [
        'title', 'content', 'latitude', 'longitude',
        'target', 'current_balance', 'collaborators', 'type'
    ];
    public function __construct(Project $model, IAttachmentRepository $attachment)
    {
        $this->model = new $model();
        $this->attachment = $attachment;
    }

    public function myPaginate(int $count = 15, int $page = 1, array $columns = ['*'])
    {
        return $this->model
            ->me()
            ->whereStatus(config('mehrino.default_status.show'))
            ->with(['institute', 'isLike', 'isBookmark'])
            ->has('institute')
            ->orderBy('created_at', 'desc')
            ->paginate($count, $columns, $pageName = null, $page);
    }

    public function paginateWithInstitute(int $institutes_id, int $count = 15, int $page = 1, array $columns = ['*'])
    {
        return $this->model
            ->where('institutes', $institutes_id)
            ->whereStatus(config('mehrino.default_status.show'))
            ->with(['institute', 'attachments', 'visit', 'visits', 'likes', 'isLike', 'isBookmark'])
            ->has('institute')
            ->orderBy('id', 'desc')
            ->paginate($count, $columns, $pageName = null, $page);
    }

    public function paginate(int $count = 15, int $page = 1, array $columns = ['*'])
    {
        return $this->model
            ->whereStatus(config('mehrino.default_status.show'))
            ->with(['institute', 'attachments', 'visit', 'user', 'isLike', 'isBookmark'])
            ->orderBy('id', 'desc')
            ->paginate($count, $columns, $pageName = null, $page);
    }


    public function mapper($res)
    {
        $projects = new ResProject();
        $data = [];
        foreach ($res as $item) {
            $data[] = mapper($projects, $item, function ($r) use ($item) {
                $r['cover'] = $r['cover'] != null ? getBaseUri($r['cover']) : null;
                $r['is_like'] = !(!$item->isLike);
                $r['is_bookmark'] = !(!$item->isBookmark);
                $r['institute'] = instituteMap($r['institute']);
                $r['user'] = userMap($item->user()->first());
                return $r;
            });
        }
        return $data;
    }

    public function updated($uuid, $request)
    {
        $project = $this->model
            ->where('uuid', $uuid)->first();
        $data = [];
        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store(uploadPath("projects/" . auth()->user()->uuid));
            $data['cover'] && imageOnQueue($data['cover']);
            $data['cover'] && deleteAll($project->cover);
        }
        if ($request->has('galleries')) {
            $galleries = collect($request->input('galleries'));
            $this->attachment->db()
            ->whereIn('uuid',  $galleries)
            ->me()
            ->update([
                'attachable_type'=> Project::class,
                'attachable_id'=> $project->id,
            ]);
        }
        foreach ($this->up_field as $input) {
            if ($request->has("$input")) {
                $data["$input"] = $request->input("$input");
            }
        }
        if (count($data) > 0)
            $project->update($data);
    }

    public function preStore(StoreProjectRequest $request, $institutes)
    {
        $data = [
            'user' => auth()->user()->id,
            'institutes' => $institutes ? $institutes->id : null,
            'cover' => null,
            'type' => 0,
            'status' => config('mehrino.default_status.store'),
        ];
        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store(uploadPath("projects/" . auth()->user()->uuid) . "/");
            $data['cover'] && imageOnQueue($data['cover']);
        }
        if ($request->has('galleries')) {
                $data['galleries'][] =$request->input('galleries');
        }
        foreach ($this->st_field as $input => $default) {
            $data["$input"] = $request->input("$input", $default);
        }
        return $data;
    }

    public function store(array $data)
    {
        DB::beginTransaction();
        $array = collect($data)->except(['galleries'])->toArray();
        $project = $this->model->query()->create($array);
        if (!$project) {
            DB::rollBack();
            httpThrow(BadRequest400());
        }
        if (collect($data)->has('galleries')) {
            $galleries = collect($data['galleries']);
            $this->attachment->db()
            ->whereIn('uuid',  $galleries)
            ->me()
            ->update([
                'attachable_type'=> Project::class,
                'attachable_id'=> $project->id
            ]);
        }
        $project->saveStatus(auth()->id(), config('mehrino.default_status.store'));
        DB::commit();
        return $project;
    }

    public function findUuid($uuid)
    {
        return $this->model->with(['full_user','institute','attachments'])->where('uuid', $uuid)->first();
    }
    public function show($uuid)
    {
        $project = $this->model
            ->whereStatus(config('mehrino.default_status.show'))
            ->with([
                'institute',
                'attachments',
                'visit',
                'likes',
                'comments',
                'isLike',
                'isBookmark'
            ])
            ->where('uuid', $uuid)->first();
        if (!$project || empty($project)) {
            return null;
        }
        $response = mapper(new ResShowProject(), $project, function ($r) use ($project) {
            $r['cover'] = $r['cover'] != null ? getBaseUri($r['cover']) : null;
            $r['is_like'] = !(!$project->isLike);
            $r['visit'] = !(!$project->visit);
            $r['is_bookmark'] = !(!$project->isBookmark);
            $r['comments'] = $project->comments()->count();
            $r['visits'] = $project->visits()->count();
            $r['likes'] = $project->likes()->count();
            return $r;
        });
        $response['galleries'] = attachMap($project->attachments()->get());
        $response['institutes'] = instituteMap($project->institute()->first());
        $response['user'] = userMap($project->user()->first());
        return $response;
    }
}
