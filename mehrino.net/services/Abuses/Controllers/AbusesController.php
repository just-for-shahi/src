<?php
namespace Services\Abuses\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Services\Abuses\Repositories\IAbusesRepository;
use Services\Abuses\Requests\AbusesRequest;
use Services\Comment\Repositories\ICommentRepository;
use Services\Institute\Repositories\IInstituteRepository;
use Services\Project\Repositories\IProjectRepository;
use Services\Voluntary\Repositories\IVoluntaryWorkRepository;
use Services\Wall\Repositories\IWallPostRepository;
/**
 * Abuses
 * @author Sajadweb
 * Sun Dec 27 2020 14:11:39 GMT+0330 (Iran Standard Time)
 */
class AbusesController extends Controller{

    private $repository;
    private $institute;
    private $project;
    private $comment;
    private $voluntary;
    private $wall;
    private $services=['comment', 'project', 'institute', 'voluntary', 'wall'];
    public function __construct(
        ICommentRepository $comment,
        IProjectRepository $project,
        IInstituteRepository $institute,
        IVoluntaryWorkRepository $voluntary,
        IWallPostRepository $wall,
        IAbusesRepository $repository){
        $this->repository = $repository;
        $this->project = $project;
        $this->institute = $institute;
        $this->comment = $comment;
        $this->voluntary = $voluntary;
        $this->wall = $wall;


    }

    public function store($service, $uuid,AbusesRequest $r)
    {
        try {
            if (!in_array($service, $this->services)) {
                return BadRequest400();
            }
            $service = $this->{$service}->db()->with(['isAbuses'])->where('uuid', $uuid)->first();
            if (!$service) {
                return NotFound404();
            }

            if ($service->isAbuses) {
                $service->isAbuses->update(['type'=>$r->type]);
                return Created201();
            }
            $service->saveAbuses(auth()->id(),$r->type);
            return Created201();

        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }

    public function destroy($uuid)
    {
        try {
           return Ok($this->repository->destroy($uuid));
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }
}
