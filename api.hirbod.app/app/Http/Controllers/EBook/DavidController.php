<?php


namespace App\Http\Controllers\EBook;


use App\Http\Controllers\Controller;
use App\Models\Attachment;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DavidController extends Controller
{


    private $entity;

    public function __construct()
    {

        $this->entity = new EBook();
    }

    public function index(Request $request){
        try{
            $data = $this->entity->latest()->paginate($request->input('count', 15), ['*'], $request->input('page', 1));
            return $this->apiResponse(ResponseHelper::$SUCCESS, 'EBooks Fetched', $data, ResponseHelper::$SUCCESS);
        }catch (\Exception $exception){
            return $this->internalError($exception);
        }
    }

    public function store(Request $request){
        try{
            $token = Str::random();
            $this->entity = EBook::create([
                'code' => Str::random(6),
                'user' => $request->user()->id,
                'title' => $request->input('title'),
                'cover' => $request->file('cover')->store('covers'),
                'introduction' => $request->input('introduction'),
                'pages' => $request->input('pages'),
                'sample' => null,
                'isbn' => $request->input('isbn'),
                'level' => $request->input('level'),
                'token' => $token
            ]);
            $publisher = Publisher::updateOrCreate([
                'name' => $request->input('publisher')
            ]);
            $this->entity->publishers()->sync($publisher, false);
            $writer = Writer::updateOrCreate([
                'name' => $request->input('writer'),
            ]);
            $this->entity->writers()->sync($writer, false);
            $sample = Attachment::create([
                'path' => $request->file('sample')->store('samples'),
                'type' => $request->file('sample')->getExtension(),
                'attachable_type' => EBook::class,
                'attachable_id' => $this->entity->id
            ]);
            $this->entity->update(['sample' => $sample->id]);
            $path = $request->file('file')->store('files');
            $path = asset($path);
            $file = PDFHelper::encrypt($path, $token, $path);
            Attachment::create([
                'path' => $file,
                'type' => $request->file('file')->getExtension(),
                'attachable_type' => EBook::class,
                'attachable_id' => $this->entity->id
            ]);
            $this->entity->categories()->sync($request->input('category'), false);
            $tags = explode('-', $request->input('tags'));
            foreach ($tags as $tag){
                $tag = Tag::updateOrCreate([
                    'name' => rtrim(ltrim($tag))
                ]);
                $this->entity->tags()->sync($tag->id, false);
            }
            return $this->apiResponse(ResponseHelper::$SUCCESS, 'EBook recorded.', $this->entity, ResponseHelper::$SUCCESS);
        }catch (\Exception $exception){
            return $this->apiResponse(500, '', $exception->getMessage(), 500);
        }
    }

}