<?php


namespace App\Http\Controllers\Tag;


use App\Facades\HResponse\HResponse;
use App\Facades\Rest\Rest;
use App\Models\Search;
use App\Models\Tag;
use Illuminate\Http\Request;

class Controller extends \App\Http\Controllers\Controller
{

    public function index(Request $r){
        try {
            if ($r->has('q')){
                $q = $r->input('q');
                $tags = Tag::search($q)->with('courses', 'podcasts', 'ebooks','events')->get();
//                return $tags;
                $data = [];
                foreach ($tags as $tag){
                    $data[] = [
                        'uuid' => $tag['uuid'],
                        'name' => $tag->name,
                        'color' => $tag->color,
                        'photo' => Rest::tempUrl($tag->photo),
                        'createdAt' => $tag->jCreated,
                        'updatedAt' => $tag->jUpdated,
                        'podcasts' => HResponse::podcasts($tag->podcasts),
                        'ebooks' => HResponse::ebooks($tag->ebooks),
                        'courses' => HResponse::courses($tag->courses),
                        'events' => HResponse::events($tag->events)
                    ];
                }
                Search::create([
                    'q' => $q,
                    'user' => auth()->id()
                ]);
            }else{
                $data = HResponse::tags(Tag::latest()->get());
            }
            return $data;
//            return Rest::success( 'Tags Fetched', $data);
        } catch (\Exception $exception) {
            return Rest::error($exception);
        }
    }



}