<?php


namespace App\Http\Controllers\Course;


use App\Http\Controllers\Controller;
use App\Models\Category;

class CourseController extends Controller
{

    private $entity;
    private $lecture;

    public function __construct()
    {
        $this->entity = new Course();
        $this->lecture = new Lecture();
    }

    public function index(){
        return view('course.list', ['courses' => Course::where('user', auth()->id())->latest()->paginate(15)]);
    }

    public function create(){
        $categories = Category::where('type', 0)->get();
        return view('course.create', [
            'categories' => $categories,
        ]);
    }

}