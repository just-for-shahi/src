<?php


namespace App\Http\Controllers\Category;


use App\Facades\HResponse\HResponse;
use App\Facades\Rest\Rest;
use App\Models\Category;
use Illuminate\Http\Request;

class Controller extends \App\Http\Controllers\Controller
{

    public function index(Request $r){
        try {
            $data = [];
            if ($r->has('type')){
                $t = intval($r->input('type'));
                $data = HResponse::categories(Category::where('type', $t)->latest()->get());
                if ($r->has('q')){
                    $data = [];
                    $category=Category::where('type', $t)->search($r->input('q'))->with(['courses', 'ebooks', 'podcasts'])->latest()->get();
                    foreach ($category as $item){
                        $data[] = [
                            'uuid' => $item->uuid,
                            'name' => $item->name,
                            'color' => $item->color,
                            'photo' => $item->photo,
                            'createdAt' => $item->jCreated,
                            'updatedAt' => $item->jUpdated,
                            'courses' => [], //@TODO: Complete this array,
                            'ebooks' => HResponse::ebooks($item->ebooks),
                            'podcasts' => HResponse::podcasts($item->podcasts)
                        ];
                    }
                }
            }else{
                $data = HResponse::categories(Category::latest()->get());
                if ($r->has('q')){
                    $data = [];
                    $category=Category::search($r->input('q'))->with(['courses', 'ebooks', 'podcasts'])->latest()->get();
                    foreach ($category as $item){
                        $data[] = [
                            'uuid' => $item->uuid,
                            'name' => $item->name,
                            'color' => $item->color,
                            'photo' => $item->photo,
                            'createdAt' => $item->jCreated,
                            'updatedAt' => $item->jUpdated,
                            'courses' => [], //@TODO: Complete this array,
                            'ebooks' => HResponse::ebooks($item->ebooks),
                            'podcasts' => HResponse::podcasts($item->podcasts)
                        ];
                    }
                }
            }
            $msg='Categories Fetched.';
            return Rest::success($msg,$data);
        } catch (\Exception $exception) {
            return Rest::error($exception);
        }
    }

    public function show($uuid, Request $r){
        try{
            $data = null;
            $with = ['courses','ebooks','podcasts'];
            if ($r->has('type')){
                switch (intval($r->input('type'))){
                    case 0:
                        $with = ['courses'];
                        break;
                    case 1:
                        $with = ['ebooks'];
                        break;
                    case 2:
                        $with = ['podcasts'];
                        break;
                    case 3:
                        $with = ['events'];
                        break;
                }
            }
            $category=Category::where(['uuid' => $uuid])->with($with)->latest()->get();
            foreach ($category as $item){
                $data = [
                    'uuid' => $item->uuid,
                    'name' => $item->name,
                    'color' => $item->color,
                    'photo' => $item->photo,
                    'createdAt' => $item->jCreated,
                    'updatedAt' => $item->jUpdated,
                    'courses' => HResponse::courses($item->courses),
                    'books' => HResponse::ebooks($item->ebooks),
                    'podcasts' => HResponse::podcasts($item->podcasts),
                    'events' => HResponse::events($item->events)
                ];
            }
            $msg='Categories Fetched.';
            return Rest::success($msg,$data);
        }catch (\Exception $e){
            return Rest::error($e);
        }
    }

}