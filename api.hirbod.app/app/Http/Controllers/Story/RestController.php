<?php

namespace App\Http\Controllers\Story;

use App\Enums\Comment\CommentStatus;
use App\Enums\Like\LikeStatus;
use App\Facades\HResponse\HResponse;
use App\Facades\Rest\Rest;
use App\Http\Controllers\Account\User;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Course\Course;
use App\Http\Controllers\EBook\EBook;
use App\Http\Controllers\Event\Event;
use App\Http\Controllers\Podcast\Podcast;
use App\Models\Like;
use App\Models\Visit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class RestController extends Controller
{
    private $entity;

    public function __construct()
    {
        $this->entity = new Story();
    }

    public  function send(Request $request){

        try {
            $validator = Validator::make($request->all() , [
                'intent_type' => 'sometimes|nullable|numeric',
                'intent_id' => 'sometimes|nullable|string',
                'file' => 'required|image|max:5120',
            ]);

            if ($validator->fails()) {
                return Rest::badRequest($validator->errors());
            }

            $type = $request->intent_type;
            $uuid = $request->intent_id;
            $msg='Story Send.';
            $date = date('Y-m');
            $model = null;

            if ($type !== null && $uuid !== null) {
                switch ($type){
                    default:
                    case 0:
                        $model = Course::where('uuid' , $uuid)->first();
                        break;
                    case 1:
                        $model = EBook::where('uuid' , $uuid)->first();
                        break;
                    case 2:
                        $model = Podcast::where('uuid' , $uuid)->first();
                        break;
                    case 3:
                        $model = Event::where('uuid' , $uuid)->first();
                        break;
                }
                if (!$model) {
                    return Rest::notFound();
                }
            }

            $this->entity->user = auth('api')->user()->id;
            $this->entity->intent_type = !is_null($type) ? $type : 0;
            $this->entity->intent_id = !is_null($model) ? $model->id : null;
            $this->entity->file = Storage::disk('liara')->put($date.'/story', $request->file('file'));
            $this->entity->save();

            $item = $this->entity;

            $data = [
                'uuid' => $item->uuid,
                'file' => Rest::tempUrl($item->file),
                'views' => $item->visits->count(),
                'likes' => $item->likes->count(),
                'liked_before' => $item->likes()->whereUser(auth('api')->id())->first() ? 'true' : 'false',
                'visit_before' => $item->visits()->whereUser(auth('api')->id())->first() ? 'true' : 'false',
                'createdAt' => $item->jCreated,
                'updatedAt' => $item->jUpdated
            ];

            return Rest::success($msg,$data);
        }catch(\Exception $e){
           return Rest::error($e);
        }

    }
    public  function show(Request $request , $uuid){

        try {
            $msg='Story Fetch.';
            $data=null;
            $story = Story::whereUuid($uuid)->with(['likes' , 'visits' , 'user' , 'comments'])->first();

            if (!$story) {
                return Rest::notFound();
            }

            if (is_null($story->intent_id)) {
                $intent_type = null;
                $intent_id = null;
            } else {
                $intent_type = $story->intent_type;
                $id = $story->intent_id;

                switch ($intent_type){
                    default:
                    case 0:
                        $model = Course::find($id);
                        break;
                    case 1:
                        $model = EBook::find($id);
                        break;
                    case 2:
                        $model = Podcast::find($id);
                        break;
                    case 3:
                        $model = Event::find($id);
                        break;
                }

                $intent_id = $model->uuid;
            }

            $visit_before = $story->visits->count() > 0 ? 'true' : 'false';

            $visit = $this->visit($uuid, $request->userAgent());

            $liked_before = Like::whereUser(auth('api')->id())
                ->where('likable_type' , get_class($story))
                ->where('likable_id' , $story->id)
                ->whereStatus(LikeStatus::LIKE)
                ->first();

            $data=[
                'user' => [
                    'uuid' => $story->user()->first()->uuid,
                    'username' => $story->user()->first()->username,
                    'avatar' => Rest::tempUrl($story->user()->first()->avatar),
                ],
                'intent_type' => $intent_type,
                'intent_id' => $intent_id,
                'likes' => count($story->likes),
                'liked_before' => $liked_before ? true : false,
                'views' => $visit,
                'visit_before' => $visit_before,
                'comments' => HResponse::comments($story->comments()->where('parent_id' , 0)->where('status' , CommentStatus::APPROVED)->latest()->get()),
                'file' => Rest::tempUrl($story->file)
            ];

           return Rest::success($msg,$data);
        }catch(\Exception $e){
           return Rest::error($e);
        }


    }
    public  function update(Request $request,$story){

        try {
            $validator = Validator::make($request->all() , [
                'file' => 'required|image|max:5120'
            ]);

            if ($validator->fails()) {
                return Rest::badRequest($validator->errors());
            }

            $file = $request->file('file');
            $msg='Story Update.';
            $date = date('Y-m');

            $story = Story::whereUuid($story)->first();
            if (!$story) {
                return Rest::notFound();
            }
            $prev_file = $story->file;

            $file_name = Storage::disk('liara')->put($date.'/story', $file);

            $story->update([
                'file' => $file_name
            ]);

            if ($story->file !== null && Storage::exists($story->file)) {
                Storage::delete($prev_file);
            }

           return Rest::success($msg,null);
        }catch(\Exception $e){
           return Rest::error($e);
        }


    }

    public  function delete($story){

        try {
            $msg='Story Delete.';
            $story = Story::whereUuid($story)->first();

            if (!$story) {
                return Rest::notFound();
            }

            Storage::delete($story->file);

            $story->delete();


           return Rest::success($msg,null);
        }catch(\Exception $e){
           return Rest::error($e);
        }
    }

    public function like($story)
    {
        try {
            $story = Story::whereUuid($story)->with(['likes'])->first();

            if (!$story) {
                return Rest::notFound();
            }

            $user = auth('api')->user();

            $liked_before = Like::whereUser(auth('api')->id())
                ->where('likable_type' , get_class($story))
                ->where('likable_id' , $story->id)
                ->whereStatus(LikeStatus::LIKE)
                ->first();

            if ($liked_before) {
                Like::whereUser(auth('api')->id())
                    ->where('likable_type' , get_class($story))
                    ->where('likable_id' , $story->id)
                    ->whereStatus(LikeStatus::LIKE)
                    ->delete();
                $msg = 'Story Unliked';
            } else {
                $story->likes()->create([
                    'user' => $user->id ,
                ]);
                $msg = 'Story liked';
            }

            $liked_count = $story->likes()->whereStatus(LikeStatus::LIKE)->count();

            return Rest::success($msg , ['like' => $liked_count]);
        } catch (\Exception $e) {
            return Rest::error($e);
        }
    }

    private function visit($uuid, $userAgent){
        try{
            $story = Story::where(['uuid' => $uuid])->with('visits')->first();

            if ($story === null){
                return Rest::notFound();
            }

            $visited = false;
            $count = count($story['visits']);
            foreach ($story['visits'] as $visit) {
                if(intval($visit->user) === intval(auth('api')->id())){
                    $visited = true;
                }
            }
            if (!$visited){
                Visit::create([
                    'user' => auth('api')->id(),
                    'current' => 'story',
                    'agent' => $userAgent,
                    'visitable_type' => Story::class,
                    'visitable_id' => $story->id
                ]);
                $count = $count+1;
            }
            return $count;
        }catch (\Exception $e){
            return Rest::error($e);
        }
    }

    public function user()
    {
        try {
            $stories = User::whereId(auth('api')->id())
                ->with(['stories','stories.visits','stories.likes'])
                ->first();

            return Rest::success('Story fetched.' , HResponse::story($stories));
        } catch (\Exception $e) {
            return Rest::error($e);
        }
    }

    public function others()
    {
        try {
            $stories = User::has('stories')
                ->with(['stories','stories.visits','stories.likes'])
                ->orderByDesc(
                    Story::select('created_at')
                        ->whereColumn('user', 'users.id')
                        ->orderByDesc('created_at')
                        ->limit(1)
                )
                ->paginate(9);

            return Rest::success('Stories fetched' , HResponse::stories($stories) , $stories->toArray());
        } catch (\Exception $e) {
            return Rest::error($e);
        }
    }

}
