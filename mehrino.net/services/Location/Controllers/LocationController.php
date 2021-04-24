<?php
namespace Services\Location\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Services\Location\Repositories\ILocationRepository;

/**
 * Location
 * @author Sajadweb
 * Wed Jan 13 2021 17:38:02 GMT+0330 (Iran Standard Time)
 */
class LocationController extends Controller{

    private $repository;
    public function __construct(ILocationRepository $repository){
        // todo add repo
        $location = require_once __DIR__."/location.php";
        $this->repository = collect($location);
    }

    public function index()
    {
        try {
            return Ok($this->repository->all());
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }

}
