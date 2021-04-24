<?php


namespace App\Http\Controllers\Course;


use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Http\Requests\UpdatePodcastRequest;
use App\Models\Category;
use App\Models\Price;
use App\Models\Tag;

class Controller extends \App\Http\Controllers\Controller
{

    private $model;

    public function __construct()
    {
        $this->model = new Course();
    }

    public function index(){
        try{
            $items = Course::me()->latest()->paginate(15);
            return view('courses.index', compact('items'));
        }catch (\Exception $e){
            return dd($e->getMessage());
        }
    }

    public function create(){
        try{
            $cats = Category::where('type', 2)->get();
            return view('courses.create', compact('cats'));
        }catch (\Exception $e){
            return dd($e->getMessage());
        }
    }

    public function store(StoreCourseRequest $r){
        try{
            $usr = auth()->id();
            $date=date('Y-m');
            $this->model = Course::create([
                'user' => $usr,
                'title' => $r->input('title'),
                'cover' => $r->file('cover')->store($date.'/courses/covers'),
                'description' => $r->input('description'),
                'introduction' => $r->input('introduction'),
                'status' => 1
            ]);
            $this->model->categories()->sync($r->input('category'), false);
            $tags = explode('-', $r->input('tags'));
            foreach ($tags as $tag){
                $tag = Tag::updateOrCreate([
                    'name' => rtrim(ltrim($tag))
                ]);
                $this->model->tags()->sync($tag->id, false);
            }
            if ($r->has('price')){
                Price::create([
                    'price' => $r->input('price'),
                    'special_price' => $r->input('special_price'),
                    'pricable_type' => Course::class,
                    'pricable_id' => $this->model->id,
                ]);
            }
            return redirect()->route('courses.index');
        }catch (\Exception $e){
            return dd($e->getMessage());
        }
    }

    public function show($uuid){
        try{
            $course = Course::where(['uuid' => $uuid, 'user' => auth()->id()])->with('tags', 'categories', 'prices')->first();
            if ($course === null){
                return abort(404);
            }
            return view('courses.show', compact('course'));
        }catch (\Exception $e){
            return dd($e->getMessage());
        }
    }

    public function update($uuid, UpdateCourseRequest $r){
        try{
            $data = [
                'title' => $r->input('title'),
                'description' => $r->input('description'),
                'introduction' => $r->input('introduction'),
            ];
            if ($r->hasFile('cover')){
                $data['cover'] = $r->file('cover')->store(date('Y-m').'/courses/covers');
            }
            Course::where(['uuid' => $uuid, 'user' => auth()->id()])->update($data);
            if ($r->has('price')){
                $course = Course::where(['uuid' => $uuid, 'user' => auth()->id()])->first();
                Price::where(['pricable_type' => Course::class, 'pricable_id' => $course['id']])->update([
                    'price' => $r->input('price'),
                    'special_price' => $r->input('special-price'),
                ]);
            }
            return redirect()->route('courses.index');
        }catch (\Exception $e){
            return dd($e);
        }
    }
}
