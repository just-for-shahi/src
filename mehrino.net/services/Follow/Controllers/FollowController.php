<?php

namespace Services\Follow\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Services\Follow\Repositories\IFollowRepository;
use Services\Institute\Repositories\IInstituteRepository;
use Services\Project\Repositories\IProjectRepository;
use Services\User\Repositories\IUserRepository;

/**
 *Follow
 * @author Sajadweb
 * Sat Jan 09 2021 19:57:43 GMT+0330 (Iran Standard Time)
 */
class FollowController extends Controller
{

    private $repository;
    private $institute;
    private $user;

    public function __construct(
        IFollowRepository $repository,
        IUserRepository $user,
        IInstituteRepository $institute
    )
    {
        $this->repository = $repository;
        $this->user = $user;
        $this->institute = $institute;
    }


    public function store($service, $uuid)
    {
        try {
            if (!in_array($service, getFollow())) {
                return BadRequest400();
            }
            $service = $this->{$service}->db()->with(['isFollow'])->where('uuid', $uuid)->first();
            if (!$service) {
                return NotFound404();
            }
            if ($service->isFollow) {
                if ($service->isFollow->delete()) {
                    return Update203(); // un follow
                }
            } else {
                if ($service->saveFollow(auth()->id())) {
                    return Created201(); //follow
                }
            }
            return BadRequest400();
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }
}
