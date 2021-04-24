<?php
namespace Services\Wishlist\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Services\Wishlist\Repositories\IWishlistRepository;

/**
 * Wishlist
 * @author Sajadweb
 * Fri Dec 25 2020 02:44:39 GMT+0330 (Iran Standard Time)
 */
class WishlistController extends Controller{

    private $repository;
    public function __construct(IWishlistRepository $repository){
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
