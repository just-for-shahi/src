<?php

namespace Services\Status\Repositories;

use Services\Status\Models\Status;
use App\Repository\Repository;
use Services\Institute\Models\Institute;
use Services\Institute\Response\ResInstitute;
use Services\Project\Models\Project;
use Services\Project\Response\ResProject;
use Services\Voluntary\Models\VoluntaryWork;
use Services\Wall\Models\WallPost;

/**
 * Status
 * @author Sajadweb
 * Sat Jan 09 2021 19:57:43 GMT+0330 (Iran Standard Time)
 */
class StatusRepository extends Repository implements IStatusRepository
{
    /**
     * The model being queried.
     *
     * @var Status
     */
    public $model;

    public function __construct(Status $model)
    {
        $this->model = new $model();
    }


    public function mapper($results)
    {
        $data = [];
        foreach ($results as $item) {
            switch ($item->statusable_type) {
                default:
                case Project::class:
                    $data[] = $this->mapperProject($item->statusable);
                    break;
                case VoluntaryWork::class:
                    $data[] = $this->mapperVoluntary($item->statusable);
                    break;
                case WallPost::class:
                    $data[] = $this->mapperWallPost($item->statusable);
                    break;
            }
        }

        return $data;
    }

    public function mapperProject($item)
    {
        if (!$item) {
            return null;
        }
        $projects = new ResProject();
        $data = mapper($projects, $item, function ($r) use ($item) {
            $r['is_like'] = !(!$item->isLike);
            $r['status'] = 'project';
            $r['is_status'] = true;
            $r['cover'] = $r['cover'] != null ? getBaseUri($r['cover']) : null;
            $r['is_bookmark'] = !(!$item->isBookmark);
            $r['institute'] = instituteMap($item->institute()->first());
            $r['user'] = userMap($item->user()->first());
            return $r;
        });
        return $data;
    }

    public function mapperVoluntary($item)
    {
        if (!$item) {
            return null;
        }
        $r = collect($item);
        $r['audience'] = $r['target_audience'];
        $r['cover'] = getBaseUri($r['cover']);
        $r['is_like'] = !(!$item->isLike);
        $r['status'] = 'voluntary';
        $r['visit'] = !(!$item->visit);
        $r['is_bookmark'] = !(!$item->isBookmark);
        $r['user'] = userMap($item->user()->first());
        $r['institutes'] = instituteMap($item->institutes()->first());
        unset($r['target_audience']);
        return $r;
    }

    public function mapperWallPost($item)
    {
        if (!$item) {
            return null;
        }
        $wall = $item->wall()->first();
        if (!$wall) {
            $wall = WallPost::withTrashed()->find($item->wall);
        }
        return [
            'wall' => [
                'uuid' => $wall->uuid ?? '',
                'title' => $wall->title ?? '',
                'cover' => $wall->cover ? getBaseUri($wall->cover) : '',
            ],
            'user' => userMap($item->user()->first()),
            'title' => $item->title,
            'uuid' => $item->uuid,
            'cover' => getBaseUri($item->cover),
            'content' => $item->content,
            'is_like' => !(!$item->isLike),
            'status' => 'wall',
            'institute' => instituteMap($item->institute()->first()),
            'is_bookmark' => !(!$item->isBookmark)
        ];
    }


    public function paginate(int $count = 15, int $page = 1, array $columns = ['*'])
    {
        $model = $this->model->with('statusable')->has('statusable');
        $search = x_search();
        if ($search) {
            $model->whereHas('statusable', function ($query) use ($search) {
                return $query->where('title', 'LIKE', "%{$search}%");
            });
        }
        return $model->latest()->paginate($count, $columns, $pageName = null, $page);
    }

    public function paginateInstitute($institute, int $count = 15, int $page = 1, array $columns = ['*'])
    {
        $model = $this->model->with('statusable')
           ->has('statusable')
            ->whereHas('statusable', function ($query) use ($institute) {
                return $query->where('institutes', $institute->id);
            });
        $search = x_search();
        if ($search) {
            $model->whereHas('statusable', function ($query) use ($search) {
                return $query->where('title', 'LIKE', "%{$search}%");
            });
        }
        return $model->latest()->paginate($count, $columns, $pageName = null, $page);
    }

    public function paginateUser($user, int $count = 15, int $page = 1, array $columns = ['*'])
    {
        $model = $this->model
        ->where('user', $user->id)
        ->with('statusable')
        ->has('statusable');
        $search = x_search();
        if ($search) {
            $model->whereHas('statusable', function ($query) use ($search) {
                return $query->where('title', 'LIKE', "%{$search}%");
            });
        }
        return $model->latest()->paginate($count, $columns, $pageName = null, $page);
    }
}
