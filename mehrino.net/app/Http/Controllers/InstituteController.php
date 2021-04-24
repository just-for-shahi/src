<?php


namespace App\Http\Controllers;


use App\Enums\ResponseCode;
use App\Models\Category;
use App\Models\Institute;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;

class InstituteController extends Controller
{

    private $model;

    public function __construct()
    {
        $this->model = new Institute();
    }

    public function index(){
        try{
            $items = $this->model->me()->latest()->paginate(15);
            return view('institutes.index', compact('items'));
        }catch (\Exception $e){
            Bugsnag::notifyException($e);
            return abort(ResponseCode::Error);
        }
    }

    public function create(){
        try{
            $categories = Category::all();
            return view('institutes.create', compact('categories'));
        }catch (\Exception $e){
            Bugsnag::notifyException($e);
            return abort(ResponseCode::Error);
        }
    }



}
