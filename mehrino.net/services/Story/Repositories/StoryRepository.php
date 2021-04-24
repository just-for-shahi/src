<?php

namespace Services\Story\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Services\Story\Models\Story;
use App\Repository\Repository;
use Services\Story\Response\ReqStoreStory;
use Services\Story\Response\ReqUpdateStory;
use Services\Story\Response\ResShowStory;
use Services\Story\Response\ResStory;
use Services\Story\Response\ResUserStory;
use Services\User\Repositories\IUserRepository;

/**
 * Story
 * @author Sajadweb
 * Fri Dec 25 2020 02:41:53 GMT+0330 (Iran Standard Time)
 */
class StoryRepository extends Repository implements IStoryRepository
{
    /**
     * The model being queried.
     *
     * @var Story
     */
    public $model;
    public $user;

    public function __construct(Story $model, IUserRepository $user)
    {
        $this->model = new $model();
        $this->user = $user;
    }

    public function save(Request $request)
    {
        $req_store = new ReqStoreStory($request);
        return $this->store($req_store->toArray());
    }

    public function updated($uuid, Request $request)
    {
        $story = $this->model->where('uuid', $uuid)->firstOrCreate();
        if ($story->file)
            Storage::delete($story->file);
        $req_store = new ReqUpdateStory($request);
        return $story->update($req_store->toArray());;
    }

    public function show($uuid)
    {
        $req_store = new ResShowStory();
        $find = $this->model
            ->with(['visits', 'visits.user'])
            ->where('uuid', $uuid)
            ->first();
        if (!$find) httpThrow(BadRequest400());

        return $req_store->setFile($find->file)->setVisits($find->visits)->toArray();
    }

    public function mapper($res)
    {
        $story = new ResStory();
        $data = [];
        foreach ($res as $item) {
            $data[] = $story->setFile($item->file)
                ->setUuid($item->uuid)
                ->setIntentType($item->intent_type)
                ->setIntentId($item->intent_id)
                ->setVisit($item->visit)
                ->setUser($item->user()->first())
                ->toArray();
        }
        return $data;
    }
    public function mapperUser($res)
    {
        $story = new ResUserStory();
        $data = [];
        foreach ($res as $item) {
            $data[] = $story->setAvatar($item->avatar)
                ->setUuid($item->uuid)
                ->setName($item->name)
                ->setStories($item->stories)
                ->toArray();
        }
        return $data;
    }

    public function paginate(int $count = 15, int $page = 1, array $columns = ['*'])
    {
        return $this->model
            ->with(['user', 'visit', 'visits'])
            ->where('user','!=', auth()->id())
            ->inDay()
            ->orderBy('created_at', 'desc')
            ->paginate($count, $columns, $pageName = null, $page);
    }
    public function paginateUser(int $count = 15, int $page = 1, array $columns = ['*'])
    {
        return $this->user->db()
            ->has('stories')
            ->with(['stories','stories.visit'])
            ->where('users.id','!=', auth()->id())
            ->orderByDesc(
                Story::select('created_at')
                    ->whereColumn('user', 'users.id')
                    ->orderByDesc('created_at')
                    ->limit(1)
            )
            ->paginate($count, $columns, $pageName = null, $page);
    }
}
