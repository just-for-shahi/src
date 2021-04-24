<?php

namespace Services\Bookmark\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Services\Bookmark\Repositories\BookmarkRepository;
use Services\Institute\Repositories\IInstituteRepository;
use Services\Project\Repositories\IProjectRepository;
use Services\Voluntary\Repositories\IVoluntaryWorkRepository;
use Services\Wall\Repositories\IWallPostRepository;

/**
 * Bookmark
 * @author Sajadweb
 * Sat Jan 09 2021 19:57:43 GMT+0330 (Iran Standard Time)
 */
class BookmarkController extends Controller
{

    private $repository;
    private $project;
    private $wall;
    private $voluntary;

    public function __construct(
        BookmarkRepository $repository,
        IProjectRepository $project,
        IVoluntaryWorkRepository $voluntary,
        IWallPostRepository $wall
    )
    {
        $this->repository = $repository;
        $this->project = $project;
        $this->voluntary = $voluntary;
        $this->wall = $wall;
    }

    public function index()
    {
        try {
            $result = $this->repository->paginate(x_count(), x_page());
            $data = $this->repository->mapper($result);
            if ($result->count() > 0)
                return Ok($data, [
                    "x-count" => $result->count(),
                    "x-page" => $result->currentPage(),
                ]);
            return NoContent204();
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }

    public function store($service, $uuid)
    {
        try {
            if (!in_array($service, getBookmark())) {
                return BadRequest400();
            }
            $service = $this->{$service}->db()->with(['isBookmark'])->where('uuid', $uuid)->first();
            if (!$service) {
                return NotFound404();
            }
            if ($service->isBookmark) {
                if ($service->isBookmark->delete()) {
                    return Update203(); // dislike
                }
            } else {
                if ($service->saveBookmark(auth()->id())) {
                    return Created201(); // bookmark
                }
            }
            return BadRequest400();
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }
}
