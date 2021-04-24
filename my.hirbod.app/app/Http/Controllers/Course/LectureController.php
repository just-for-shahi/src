<?php


namespace App\Http\Controllers\Course;



use Illuminate\Http\Request;

class LectureController extends \App\Http\Controllers\Controller
{

    private $model;

    public function __construct()
    {
        $this->model = new Lecture();
    }

    public function index($uuid){
        try{
            $cid = Course::where(['uuid' => $uuid])->first();
            if ($cid === null){
                return back();
            }
            $items = Lecture::where(['course' => $cid['id']])->latest()->paginate(15);
            return view('courses.lectures.index', compact('uuid', 'items'));
        }catch (\Exception $e){
            return dd($e->getMessage());
        }
    }

    public function store($uuid, Request $r){
        try{
            $date=date('Y-m');
            $course = Course::where(['uuid' => $uuid, 'user' => auth()->id()])->first();
            if ($course === null){
                return back();
            }
            Lecture::create([
                'course' => $course['id'],
                'parent' => null, //@TODO: Complete this param
                'title' => $r->input('title'),
                'duration' => 0,
                'description' => $r->input('description'),
                'type' => 0,
                'file' => $r->file('file')->store($date.'/courses/lectures'),
                'plus' => $r->input('plus'),
                'status' => 1
            ]);
            return redirect()->route('lectures.index', ['uuid' => $uuid]);
        }catch (\Exception $e){
            return dd($e->getMessage());
        }
    }

    public function destroy($uuid, $luuid){
        try{
            return abort(404);
        }catch (\Exception $e){
            return dd($e->getMessage());
        }
    }
}
