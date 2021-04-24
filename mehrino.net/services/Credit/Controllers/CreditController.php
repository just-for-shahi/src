<?php
namespace Services\Credit\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Services\Credit\Repositories\ICreditRepository;

/**
 * Credit
 * @author Sajadweb
 * Sun Dec 27 2020 13:50:31 GMT+0330 (Iran Standard Time)
 */
class CreditController extends Controller{

    private $repository;
    public function __construct(ICreditRepository $repository){
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

    public function update($uuid,Request $request)
    {
        try {
            return Ok($this->repository->update($uuid,$request->all()));
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
