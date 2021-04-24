<?php

namespace App\Http\Controllers\Podcast;

use App\Facades\HResponse\HResponse;
use App\Facades\Rest\Rest;
use App\Http\Controllers\Account\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApiRequest;
use App\Http\Requests\EpisodeRequest;
use App\Http\Requests\PodcastRequest;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MyController extends Controller
{
    private $obj;

    public function __construct()
    {
        $this->obj = new Podcast();
    }

    public function index(Request $r){
        try{
            $msg='Podcasts fetched.';
            $items = $this->obj->me()->latest()->with(['tags', 'categories','prices'])->paginate($r->input('count', 15), ['*'], $r->input('page', 1));
            $data = [];
            foreach ($items as $item){
                $price = count($item->prices) > 0 ? $item->prices[0]->price : 0;
                $data[] = [
                    'uuid' => $item->uuid,
                    'title' => $item->title,
                    "price"=>$price,
                    'logo' => Storage::disk('liara')->temporaryUrl(
                        $item->logo,
                        now()->addMinutes(config('hirbod.temporary.podcasts.owner')),
                        ['ResponseContentType' => 'application/octet-stream']
                    ),
                    'cover' => Storage::disk('liara')->temporaryUrl(
                        $item->cover,
                        now()->addMinutes(config('hirbod.temporary.podcasts.owner')),
                        ['ResponseContentType' => 'application/octet-stream']
                    ),
                    'status' => $item->status,
                    'tags' => HResponse::tags($item->tags),
                    'categories' => HResponse::categories($item->categories),
                    'createdAt' => $item->created_at,
                    'updatedAt' => $item->update_at
                ];
            }
            return Rest::success($msg, $data);
        }catch (\Exception $e){
            return Rest::error($e);
        }
    }


    public function store(Request $r){
        try{
            $access=new ApiRequest(new PodcastRequest(),[
                'user'=>auth('api')->user()->id,
            ]);
            if($access::validate($r)['code']){
                $msg="Success Store";
                $this->obj->user = auth()->id();
                $this->obj->title = $r->input('title');
                $this->obj->description = $r->input('description');
                $this->obj->website = $r->input('website');
                $this->obj->cover =Storage::disk('liara')->put(date('Y-m').'/podcasts/'.$r->input('title'), $r->file('cover'));
                $this->obj->logo =Storage::disk('liara')->put(date('Y-m').'/podcasts/'.$r->input('title'), $r->file('logo'));
                $this->obj->save();
                return Rest::success($msg, null);
            }
            $msg="Error Store";
            return Rest::badRequest($msg, $access::validate($r)['message']);
        }catch (\Exception $e){
            return Rest::error($e);
        }
    }

    public function show($uuid){

        try {
            $podcast=Podcast::me()->with('episodes','prices')->where('uuid',$uuid)->firstOrFail();
            $price = count($podcast->prices) > 0 ? $podcast->prices[0]->price : 0;
            $data=[
                "uuid"=>$podcast->uuid,
                "title"=>$podcast->title,
                "price"=>$price,
                'logo' => Storage::disk('liara')->temporaryUrl(
                    $podcast->logo,
                    now()->addMinutes(config('hirbod.temporary.podcasts.owner')),
                    ['ResponseContentType' => 'application/octet-stream']
                ),
                'cover' => Storage::disk('liara')->temporaryUrl(
                    $podcast->cover,
                    now()->addMinutes(config('hirbod.temporary.podcasts.owner')),
                    ['ResponseContentType' => 'application/octet-stream']
                ),
                "episodes"=>$podcast->episodes,
                "username"=> User::find($podcast->user)->username,
                "createdAt"=>$podcast->created_at,
                "updatedAt"=> $podcast->updatetd_at
            ];
            return Rest::success('Podcast fetched.', $data);
        }catch(\Exception $e){
            return Rest::error($e);
        }
    }


    public  function storeEpisode(Request $r){
        try{
            $access=new ApiRequest(new EpisodeRequest(),[
                'user'=>auth('api')->user()->id,
            ]);
            if($access::validate($r)['code']){
                $podcast=Podcast::whereId($r->input('podcast'))->firstOrFail()->id;
                $msg="Success Store";
                $this->obj->user = auth()->id();
                $this->obj->title = $r->input('title');
                $this->obj->podcast = $podcast;
                $this->obj->file = Storage::disk('liara')->put(date('Y-m').'/podcasts/episode/'.$r->input('title'), $r->file('file'));
                $this->obj->save();
                $category = Category::where('uuid', $r->input('category'))->first();
                $this->obj->categories()->sync($category['id'], false);
                if($r->has('tags')) {
                    $tags = explode('-', $r->input('tags'));
                    foreach ($tags as $tag) {
                        $tag = Tag::updateOrCreate([
                            'uuid' => Str::uuid(),
                            'name' => rtrim(ltrim($tag))
                        ]);
                        $this->obj->tags()->sync($tag['id'], false);
                    }
                }
                return Rest::success($msg, null);
            }
            $msg="Error Store";
            return Rest::badRequest($msg, $access::validate($r)['message']);
        }catch (\Exception $e){
            return Rest::error($e);
        }
    }
}
