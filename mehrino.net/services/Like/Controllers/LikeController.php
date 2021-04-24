<?php

namespace Services\Like\Controllers;

use App\Http\Controllers\Controller;
use Services\Comment\Repositories\ICommentRepository;
use Services\Institute\Repositories\IInstituteRepository;
use Services\Like\Repositories\ILikeRepository;
use Services\Like\Requests\LikeRequest;
use Services\Project\Repositories\IProjectRepository;
use Services\Voluntary\Repositories\IVoluntaryWorkRepository;
use Services\Wall\Repositories\IWallPostRepository;

/**
 * Like
 * @author Sajadweb
 * Fri Dec 25 2020 02:40:00 GMT+0330 (Iran Standard Time)
 */
class LikeController extends Controller
{

    private $repository;
    private $institute;
    private $project;
    private $comment;
    private $voluntary;
    private $wall;

    private $services;

    public function __construct(
        ILikeRepository $repository,
        ICommentRepository $comment,
        IProjectRepository $project,
        IInstituteRepository $institute,
        IVoluntaryWorkRepository $voluntary,
        IWallPostRepository $wall
    ) {
        $this->repository = $repository;
        $this->project = $project;
        $this->institute = $institute;
        $this->comment = $comment;
        $this->voluntary = $voluntary;
        $this->wall = $wall;

        $this->services = ['comment', 'project', 'institute', 'voluntary', 'wall'];
    }

    public function likeUpdate($service, $uuid)
    {
        try {
            if (!in_array($service, $this->services)) {
                return BadRequest400();
            }
            $service = $this->{$service}->db()->with(['isLike', 'isDislike'])->where('uuid', $uuid)->first();
            if (!$service) {
                return NotFound404();
            }

            if ($service->isLike) {
                if ($service->isLike->delete()) {
                    return Update203(); // dislike
                }
            } else {
                if ($service->saveLike(auth()->id())) {
                    if ($service->isDislike) {
                        if (!$service->isDislike->delete()) {
                            return BadRequest400();
                        }
                    }
                    return Created201(); // like
                }
            }
            return BadRequest400();
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }

    public function dislikeUpdate($service, $uuid)
    {
        try {
            if (!in_array($service, $this->services)) {
                return BadRequest400();
            }
            $service = $this->{$service}->db()->with(['isDislike'])->where('uuid', $uuid)->first();
            if (!$service) {
                return NotFound404();
            }
            if ($service->isDislike) {
                if ($service->isDislike->delete()) {
                    return Update203(); // remove action
                }
            } else {
                if ($service->saveDisLike(auth()->id())) {
                    if ($service->isLike) {
                        if (!$service->isLike->delete()) {
                            return BadRequest400();
                        }
                    }
                    return Created201(); // add action
                }
            }
            return BadRequest400();
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }
}
