<?php


namespace App\Http\Controllers\Podcast;


use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class DavidController extends Controller
{


    private $entity;

    public function __construct()
    {

        $this->entity = new Podcast();
    }

    public function index(Request $request){
        try{
            $data = $this->entity->latest()->paginate($request->input('count', 15), ['*'], $request->input('page', 1));
            $data->map(function($item){
                if ($item['logo']){
                    return $item['logo'] = ResponseHelper::$STATIC_SERVER.$item->logo;
                }
                if ($item['updated_at']){
                    return $item['updated_at'] = $item->jUpdated;
                }
                return $item;
            });
            return $this->apiResponse(ResponseHelper::$SUCCESS, 'Podcasts Fetched', $data, ResponseHelper::$SUCCESS);
        }catch (\Exception $exception){
            return $this->internalError($exception);
        }
    }

    public function store(Request $request){
        try{
            $date = date('Y-m');
            $this->entity = Podcast::create([
                'user' => $request->user()->id,
                'name' => $request->input('name'),
                'logo' => $request->file('logo')->store($date.'/logo'),
                'cover' => $request->file('cover')->store($date.'/cover'),
                'description' => $request->input('description'),
                'website' => $request->input('website'),
            ]);
            $this->entity->categories()->sync($request->input('category'), false);
            $tags = explode('-', $request->input('tags'));
            foreach ($tags as $tag){
                $tag = Tag::updateOrCreate([
                    'name' => rtrim(ltrim($tag))
                ]);
                $this->entity->tags()->sync($tag->id, false);
            }
            return $this->apiResponse(ResponseHelper::$SUCCESS, 'Podcast Stored.', $this->entity, ResponseHelper::$SUCCESS);
        }catch (\Exception $exception){
            return $this->apiResponse(500, '', $exception->getMessage(), 500);
        }
    }

}