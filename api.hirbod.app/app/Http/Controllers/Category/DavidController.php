<?php


namespace App\Http\Controllers\Category;


use App\Facades\Rest\Rest;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class DavidController extends Controller
{

    private $entity;

    public function __construct()
    {
        $this->entity = new Category();
    }

    public function index(Request $request){
        try{
            $data = $this->entity->where('type', $request->input('type', 0))->latest()->paginate($request->input('count', 15), ['*'], $request->input('page', 1));
            return Rest::success('Categories Fetched', $data);
        }catch (\Exception $exception){
            return Rest::error($exception);
        }
    }

    public function store(){

    }

}