<?php

namespace Services\Tag\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Services\Tag\Repositories\ITagRepository;

/**
 * Tag
 * @author Sajadweb
 * Fri Dec 25 2020 02:42:18 GMT+0330 (Iran Standard Time)
 */
class TagController extends Controller
{

    private $repository;
    public function __construct(ITagRepository $repository)
    {
        // todo add repo
        $this->repository = $repository;
    }

    public function index()
    {
        try {
            return Ok($this->repository->all());
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }

    public function store(Request $request)
    {
        try {
            return Ok($this->repository->store($request->all()));
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }

    public function  show($uuid)
    {
        try {
            return Ok($this->repository->show($uuid));
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }

    public function update($uuid, Request $request)
    {
        try {
            return Ok($this->repository->update($uuid, $request->all()));
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
