<?php

namespace Services\Project\Repositories;


use Illuminate\Support\Facades\DB;
use Services\Project\Models\Project;
use App\Repository\Repository;
use Services\Project\Models\ProjectReport;
use Services\Project\Response\ReqStoreProjectReport;

/**
 * ProjectReport
 * @author Sajadweb
 * Mon Jan 04 2021 03:21:07 GMT+0330 (Iran Standard Time)
 */
class ProjectReportRepository extends Repository implements IProjectReportRepository
{
    /**
     * The model being queried.
     *
     * @var ProjectReport
     */
    public $model;

    public function __construct(ProjectReport $model)
    {
        $this->model = new $model();
    }

    public function paginate(int $count = 15, int $page = 1, array $columns = ['*'])
    {
        return $this->model->with(['attachment', 'user'])->paginate($count, $columns, $pageName = null, $page);
    }

    public function saved($request, Project $project)
    {
        return DB::transaction(function () use ($request, $project) {
            $data = $request->only(['title', 'content']);
            if ($request->hasFile('cover'))
                $data['cover'] = $request->file('cover')->store(uploadPath("institute/project-report/" . auth()->user()->uuid));
            $data['institutes'] = $project->institutes;
            $data['project'] = $project->id;
            $data['user'] = auth()->id();
            $report = $this->model->create($data);
            if ($report) {
                if ($request->hasFile('galleries')) {
                    foreach ($request->file('galleries') as $file) {
                        $path = $file->store(uploadPath("institute/project-report/" . auth()->user()->uuid));
                        $type = $file->getClientMimeType();
                        $report->attachment($path, $type, auth()->id());
                    }
                }
            }
        });
    }

    public function update($where, array $data)
    {
        return parent::update($where, $data);
    }


    public function mapper($res)
    {
        $data = [];
        foreach ($res as $item) {
            $user = $item->user()->first(['uuid', 'name', 'avatar']);
            $user->avatar = getBaseUri($user->avatar);
            $data[] = [
                'title' => $item->title,
                'content' => $item->content,
                'cover' => getBaseUri($item->cover),
                'galleries' => collect($item->attachments)->map(function ($item) {
                    return getBaseUri($item->path);
                })->all(),
                'user' => $user,
                'createdAt' => $item->created_at,
            ];
        }
        return $data;
    }

    public function paginateWithProject(int $project_id, int $count = 15, int $page = 1, array $columns = ['*'])
    {
        return $this->model
            ->where('project', $project_id)
            ->with(['attachments', 'user'])
            ->orderBy('id', 'desc')
            ->paginate($count, $columns, $pageName = null, $page);
    }
}
