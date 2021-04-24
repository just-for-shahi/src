<?php


namespace App\Http\Controllers;


use App\Helpers\ResponseHelper;
use App\Models\Wishlist;

class WishlistController extends Controller
{
    private $entity;
    private $response;

    public function __construct()
    {
        $this->entity = new Wishlist();
        $this->response = new ResponseHelper();
    }
    public function index(){
        try {
            $event = Wishlist::latest()->get();

            $wishlistable = $event;
            return dd($wishlistable);


            $wishlist = Wishlist::where(['user'=>auth()->user()->id])->with('events');


            $data = [
                [
                    'title' => 'Stories',
                    'items' => $wishlist
                ],


            ];
            if (is_null($data)) {
                return $this->response->badRequest();
            }

            return $this->response->apiResponse(ResponseHelper::$SUCCESS, 'Course Fetched.', $data, ResponseHelper::$SUCCESS);
        } catch (\Exception $e) {
//            return $this->response->internalError($e);
            return dd($e->getMessage());

        }
    }
}