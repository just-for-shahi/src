<?php

namespace Services\Visit\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Services\Project\Repositories\IProjectRepository;
use Services\Story\Repositories\IStoryRepository;
use Services\Visit\Repositories\IVisitRepository;
use Services\Voluntary\Repositories\IVoluntaryWorkRepository;
use Services\Wall\Repositories\IWallPostRepository;
use Services\Wall\Repositories\IWallRepository;

/**
 * Visit
 * @author Sajadweb
 * Fri Dec 25 2020 02:43:12 GMT+0330 (Iran Standard Time)
 */
class VisitController extends Controller
{

    private $story;
    private $project;
    private $wall;
    private $wall_post;
    private $voluntary;
    private $repository;

    public function __construct(
        IVisitRepository $repository,
        IStoryRepository $story,
        IProjectRepository $project,
        IWallRepository $wall,
        IWallPostRepository $wall_post,
        IVoluntaryWorkRepository $voluntary
    )
    {
        $this->repository = $repository;
        $this->story = $story;
        $this->project = $project;
        $this->wall = $wall;
        $this->wall_post = $wall_post;
        $this->voluntary = $voluntary;
    }

protected function checkService($service)
{
    return !in_array($service, ['story', 'project', 'wall', 'wall_post', 'voluntary']);
}

public function update($service, $uuid, Request $request)
{
    try {
        if ($this->checkService($service)) {
            return BadRequest400();
        }
        $serve = $this->{$service}->db()->with([
            'visit'
        ])->where('uuid', $uuid)->first();
        if (!$serve) {
            return BadRequest400();
        }
        if ($serve->visit) {
            return NotFound404();
        }

        $create = $serve->saveVisit([
            'current' => "visit $serve->id",
            'agent' => $request->userAgent(),
            "user" => auth()->id()
        ]);

        if ($create) {
            return Created201();
        }
        return BadRequest400();
    } catch (\Exception $exp) {
        InternalServerError500($exp);
    }
}

}
