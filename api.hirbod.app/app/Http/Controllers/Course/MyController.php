<?php

namespace App\Http\Controllers\Course;

use App\Facades\HResponse\HResponse;
use App\Facades\Rest\Rest;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MyController extends Controller
{
    public function index(Request $request)
    {
        try {
            $msg = __('message.fetch' , ['name' => 'Courses']);
            $courses = Course::me()
                ->with(['lectures','categories','tags','likes','visits','prices'])
                ->latest()
                ->paginate($request->input('count' , 15) , ['*'] , $request->input('page' , 1));

            $data = HResponse::courses($courses);

            return Rest::success($msg , $data);
        } catch (\Exception $e) {
            return Rest::error($e);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all() , [
                'title' => 'required|string',
                'cover' => 'required|image|max:5120',
                'description' => 'sometimes|nullable|string',
                'introduction' => 'sometimes|nullable|string',
                'students' => 'sometimes|nullable|numeric',
                'duration' => 'sometimes|nullable|string',
                'level' => 'sometimes|nullable|numeric',
                'status' => 'sometimes|nullable|numeric',
                'price' => 'sometimes|nullable|numeric',
                'categories' => 'required|array',
                'tags' => 'required|array'
            ]);

            if ($validator->fails()) {
                return Rest::badRequest($validator->errors());
            }

            $user = auth('api')->user();
            $msg = __('message.store' , ['name' => 'Course']);

            DB::beginTransaction();

            $categories = Category::whereIn('uuid' , $request->categories)->get(['id'])->map(function ($item) {
                return $item->id;
            });

            $tags = Tag::whereIn('uuid' , $request->tags)->get(['id'])->map(function ($item) {
                return $item->id;
            });

            $file = $request->file('cover');
            $date = date('Y-m');
            $file_name = Storage::disk('liara')->put($date.'/course', $file);

            $course = Course::create([
                'user' => $user->id,
                'title' => $request->title,
                'cover' => $file_name,
                'description' => $request->description,
                'introduction' => $request->introduction,
                'students' => $request->students ?? 0,
                'duration' => $request->duration,
                'level' => $request->level,
                'status' => $request->status,
            ]);
            if (!$course) {
                DB::rollBack();
                return Rest::error(__('message.failed' , ['name' => 'Store']));
            }
            $course->prices()->create([
                'price' => $request->price,
            ]);

            $course->categories()->sync(count($categories) > 0 ? $categories : $course->categories);

            $course->tags()->sync(count($tags) > 0 ? $tags : $course->tags);

            DB::commit();
            return Rest::success($msg,null);
        } catch (\Exception $e) {
            return Rest::error($e);
        }
    }

    public function update(Request $request ,$uuid)
    {
        try {
            $validator = Validator::make($request->all() , [
                'title' => 'sometimes|nullable|string',
                'cover' => 'sometimes|nullable|image|max:5120',
                'description' => 'sometimes|nullable|string',
                'introduction' => 'sometimes|nullable|string',
                'students' => 'sometimes|nullable|numeric',
                'duration' => 'sometimes|nullable|string',
                'level' => 'sometimes|nullable|numeric',
                'status' => 'sometimes|nullable|numeric',
                'price' => 'sometimes|nullable|numeric',
                'categories' => 'required|array',
                'tags' => 'required|array'
            ]);

            if ($validator->fails()) {
                return Rest::badRequest($validator->errors());
            }

            $user = auth('api')->user();
            $msg = __('message.update' , ['name' => 'Course']);

            DB::beginTransaction();

            $categories = Category::whereIn('uuid' , $request->categories)->get(['id'])->map(function ($item) {
                return $item->id;
            });

            $tags = Tag::whereIn('uuid' , $request->tags)->get(['id'])->map(function ($item) {
                return $item->id;
            });

            $course = Course::me()
                ->whereUuid($uuid)
                ->with(['lectures','categories','prices'])
                ->first();

            $prev_file = $course->cover;

            if ($request->hasFile('cover')) {
                $file = $request->file('cover');
                $date = date('Y-m');
                $file_name = Storage::disk('liara')->put($date.'/course', $file);
            } else {
                $file_name = null;
            }

            $update = $course->update([
                'title' => $request->title ?? $course->title,
                'cover' => $file_name,
                'description' => $request->description ?? $course->description,
                'introduction' => $request->introduction ?? $course->introduction,
                'students' => $request->students ?? $course->students,
                'duration' => $request->duration ?? $course->duration,
                'level' => $request->level ?? $course->level,
                'status' => $request->status ?? $course->status,
            ]);

            if (!$update) {
                DB::rollBack();
                return Rest::error(__('message.failed' , ['name' => 'Update']));
            }

            $course->prices()->latest()->first()->update([
               'price' => $request->price ?? $course->price
            ]);

            $course->categories()->sync(count($categories) > 0 ? $categories : $course->categories);
            $course->tags()->sync(count($tags) > 0 ? $tags : $course->tags);

            if ($course->cover !== null && Storage::exists($course->cover)) {
                Storage::delete($prev_file);
            }

            DB::commit();
            return Rest::success($msg , null);
        } catch (\Exception $e) {
            return Rest::error($e);
        }
    }

    public function destroy($uuid)
    {
        try {
            $msg = __('message.delete' , ['name' => 'Course']);
            $course = Course::me()
                ->whereUuid($uuid)
                ->first();

            if ($course->cover !== null && Storage::exists($course->cover)) {
                Storage::delete($course->cover);
            }

            $course->delete();

            return Rest::success($msg , null);
        } catch (\Exception $e) {
            return Rest::error($e);
        }
    }
}
