<?php

namespace Services\Bookmark\Repositories;

use Services\Bookmark\Models\Bookmark;
use App\Repository\Repository;
use Services\Institute\Models\Institute;
use Services\Institute\Response\ResInstitute;
use Services\Project\Models\Project;
use Services\Project\Response\ResProject;
use Services\Voluntary\Models\VoluntaryWork;
use Services\Wall\Models\WallPost;

/**
 * Bookmark
 * @author Sajadweb
 * Sat Jan 09 2021 19:57:43 GMT+0330 (Iran Standard Time)
 */
class BookmarkRepository extends Repository implements IBookmarkRepository
{
    /**
     * The model being queried.
     *
     * @var Bookmark
     */
    public $model;

    public function __construct(Bookmark $model)
    {
        $this->model = new $model();
    }


    public function mapper($results)
    {
        $data = [];
        foreach ($results as $item) {
            switch ($item->bookmarkable_type) {
                default:
                case Project::class:
                    $data[] = $this->mapperProject($item->bookmarkable);
                    break;
                case VoluntaryWork::class:
                    $data[] = $this->mapperVoluntary($item->bookmarkable);
                    break;
                case WallPost::class:
                    $data[] = $this->mapperWallPost($item->bookmarkable);
                    break;
            }
        }

        return $data;
    }

    public function mapperProject($item)
    {
        $projects = new ResProject();
        $data = mapper($projects, $item, function ($r) use ($item) {
            $r['is_like'] = !(!$item->isLike);
            $r['status'] = 'project';
            $r['is_status'] = true;
            $r['cover'] = $r['cover'] != null ? getBaseUri($r['cover']) : null;
            $r['institute'] = instituteMap($item->institute()->first());
            $r['user'] = userMap($item->user()->first());
            $r['is_bookmark'] = !(!$item->isBookmark);
            return $r;
        });
        return $data;
    }

    public function mapperVoluntary($item)
    {
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
        $wall = $item->wall()->first();
        return [
            'wall' => [
                'uuid' => $wall->uuid,
                'title' => $wall->title,
                'cover' => getBaseUri($wall->cover),
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
        return $this->model->me()->has('bookmarkable')->with(['bookmarkable', 'bookmarkable.isLike', 'bookmarkable.isBookmark', 'bookmarkable.institute', 'bookmarkable.user'])->paginate($count, $columns, $pageName = null, $page);
    }
}
