<?php

namespace App\Http\Controllers\Event;

use App\Enums\Comment\CommentStatus;
use App\Enums\Like\LikeStatus;
use App\Facades\HResponse\HResponse;
use App\Facades\Rest\Rest;
use App\Http\Controllers\Account\User;
use App\Http\Controllers\Finance\Transaction;
use App\Models\Category;
use App\Models\Like;
use App\Models\Tag;
use App\Models\Visit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class Controller extends \App\Http\Controllers\Controller
{
    public function index(){
        try {
            $msg= 'Events Fetched.';
            $events = Event::latest()->with(['prices','speakers','tags','categories','user'])->get();
            return Rest::success($msg,HResponse::events($events));
        } catch (\Exception $exception) {
            return Rest::error($exception);
        }
    }

    public function show($uuid, Request $request){
        try {
            $msg='Events fetched.';
            $purchase = true;
            $event = Event::where('uuid' , $uuid)->with(['prices','tags','categories','likes','visits','comments','comments.replies.user','comments.likes','comments.user','user'])->firstOrFail();
            if (!$event){
                return Rest::notFound();
            }
            if (\auth('api')->check()) {
                $liked = $event->likes()->whereUser(\auth('api')->id())->first() ? true : false;
            } else {
                $liked = false;
            }
            $visit = $this->visit($uuid, $request->userAgent());

            $price = 0;
            if(count($event->prices)>0){
                $price = $event->prices()->latest()->first()->price;
            }

            $transactions = Transaction::whereUser(\auth('api')->id())
                ->where('transactional_type' , get_class($event))
                ->where('transactional_id' , $event->id)
                ->whereStatus('1')
                ->first();

            !empty($transactions) ? $is_buy = true : $is_buy = false;

            if ($event->categories()->count() > 0) {
                $related = Category::where(['uuid' => $event->categories()->first()->uuid])->latest()->with(['events'])->first();
            } else {
                $related = [];
            }

            $duration = Carbon::parse($event->from)->diffInHours($event->till);

            $data=[
                'uuid' => $event->uuid,
                'from' => $event->from,
                'till' => $event->till,
                'duration' => $duration,
                'location' => $event->location,
                'title' => $event->title,
                'introduction' => $event->introduction,
                'cover' => Rest::tempUrl($event->cover),
                'contributor' => $event->contributor,
                'address' => $event->address,
                'latitude' => $event->latitude,
                'longitude' => $event->longitude,
                'live' => $event->live,
                'video' => $event->video,
                'dedicated' => $event->dedicated,
                'private' => $event->private,
                'type' => $event->type,
                'status' => $event->status,
                'username' => $event->user()->first()->username,
                'speakers' => HResponse::speackers($event->speakers),
                'price' => $event->prices()->latest()->first() !== null ? $event->prices()->latest()->first()->price : null,
                'categories' => HResponse::categories($event->categories),
                'tags' => HResponse::tags($event->tags),
                'views' => $visit,
                'likes' => $event->likes()->whereStatus(LikeStatus::LIKE)->get()->count(),
                'rate' => 4.1,
                'liked' => $liked,
                'purchase' => $is_buy,
                'related' => !empty($related) ? HResponse::eventsRelated($related , $event->uuid) : [],
                'comments' => HResponse::comments($event->comments()->where('parent_id' , 0)->where('status' , CommentStatus::APPROVED)->latest()->get()),
                'createdAt'=> $event->jCreated,
                'updatedAt'=> $event->jUpdated,

            ];
            if ($request->bearerToken() && $purchase && $request->header('secret') === config('hirbod.secret')) {
                $data['secret'] = true;
            }
            return Rest::success($msg,$data);
        }catch(\Exception $e){
            return Rest::error($e);
        }
    }

    public function like($uuid){
        try{
            $event = Event::where(['uuid' => $uuid])->with('likes')->first();
            if ($event === null){
                return Rest::notFound();
            }
            $liked = false;
            $count = count($event['likes']);
            foreach ($event['likes'] as $like) {
                if(intval($like->user) === intval(auth('api')->id())){
                    $liked = true;
                }
            }
            if (!$liked){
                Like::create([
                    'user' => auth('api')->id(),
                    'likable_type' => Event::class,
                    'likable_id' => $event['id'],
                ]);
                ++$count;
            }
            else {
                foreach (Event::where(['uuid' => $uuid])->get() as $item) {
                    $item->likes()->whereUser(auth('api')->id())->delete();
                }
                --$count;
            }
            return Rest::success('Success', ['likes' => $count]);
        }catch (\Exception $e){
            return Rest::error($e);
        }
    }

    private function visit($uuid, $userAgent){
        try{
            $event = Event::where(['uuid' => $uuid])->with('visits')->first();
            if ($event === null){
                return Rest::notFound();
            }
            $visited = false;
            $count = count($event['visits']);
            foreach ($event['visits'] as $visit) {
                if(intval($visit->user) === intval(auth('api')->id())){
                    $visited = true;
                }
            }
            if (!$visited){
                Visit::create([
                    'user' => auth('api')->id(),
                    'current' => 'Event',
                    'agent' => $userAgent,
                    'visitable_type' => Event::class,
                    'visitable_id' => $event->id
                ]);
                ++$count;
            }
            return $count;
        }catch (\Exception $e){
            return Rest::error($e);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all() , [
                'from' => 'sometimes|nullable',
                'till' => 'sometimes|nullable',
                'location' => 'sometimes|nullable|string',
                'title' => 'sometimes|nullable|string',
                'introduction' => 'sometimes|nullable|string',
                'cover' => 'sometimes|nullable|image|max:5120',
                'contributor' => 'sometimes|nullable|numeric',
                'address' => 'sometimes|nullable|string',
                'latitude' => 'sometimes|nullable',
                'longitude' => 'sometimes|nullable',
                'live' => 'sometimes|nullable|numeric',
                'video' => 'sometimes|nullable|numeric',
                'dedicated' => 'sometimes|nullable|numeric',
                'private' => 'sometimes|nullable|numeric',
                'type' => 'sometimes|nullable|numeric',
                'status' => 'sometimes|nullable|numeric'
            ]);

            if ($validator->fails()) {
                return Rest::badRequest($validator->errors());
            }

            $user = auth('api')->user();
            $msg = 'Event Store.';

            if ($request->hasFile('cover')) {
                $file = $request->file('cover');
                $date = date('Y-m');
                $file_name = Storage::disk('liara')->put($date.'/event', $file);
            } else {
                $file_name = null;
            }

            $event = Event::create([
                'user' => $user->id,
                'from' => $request->from,
                'till' => $request->till,
                'location' => $request->location,
                'title' => $request->title,
                'introduction' => $request->introduction,
                'cover' => $file_name,
                'contributor' => $request->contributor,
                'address' => $request->address,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'live' => $request->live,
                'video' => $request->video,
                'dedicated' => $request->dedicated,
                'private' => $request->private,
                'type' => $request->type,
                'status' => $request->status
            ]);

            $event->prices()->create([
                'price' => 1000,
            ]);

            $event->categories()->sync([
                'category_id' => Category::whereUuid('2a5ae5dc-030b-4832-9016-d07f102034fa')->first()->id
            ]);

            $event->tags()->sync([
               'tag_id' => Tag::whereUuid('a2ebeaeb-2991-4f8d-9f66-214d94a9ad41')->first()->id
            ]);

            $event->speakers()->create([
                'name' => 'vahiidrah',
                'avatar' => 'public/upload/images/avatars/17_vahiidrah/IMG_20210102_132657_874.jpg/SJ8h03cBTxXpq94dTthGI8TLGxnEXMckxLDPvzWk.jpg',
                'bio' => 'developer'
            ]);

            return Rest::success($msg,null);
        } catch (\Exception $e) {
            return Rest::error($e);
        }
    }

    public function destroy($uuid)
    {
        try {
            $msg = 'Event Deleted.';
            $event = Event::whereUuid($uuid)->first();

            if (!$event) {
                return Rest::notFound();
            }

            if ($event->cover !== null && Storage::exists($event->cover)) {
                Storage::delete($event->cover);
            }

            if ($event->speakers()->first()->avatar !== null && Storage::exists($event->speakers()->first()->avatar)) {
                Storage::delete($event->speakers()->first()->avatar);
            }

            $event->prices()->forceDelete();
            $event->speakers()->forceDelete();
//            $event->categories()->forceDelete();
//            $event->tags()->forceDelete();

            $event->forceDelete();

            return Rest::success($msg , null);
        } catch (\Exception $e) {
            return Rest::error($e);
        }
    }
}
