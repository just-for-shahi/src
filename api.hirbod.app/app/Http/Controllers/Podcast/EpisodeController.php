<?php


namespace App\Http\Controllers\Podcast;


use App\Facades\Rest\Rest;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEpisodeRequest;
use App\Models\Category;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Illuminate\Support\Facades\Storage;

class EpisodeController extends Controller
{


    private $entity;

    public function __construct()
    {

        $this->entity = new Episode();

    }

    public function index (){
        try{
            return view('episode.list', ['episodes' => Episode::latest()->paginate(15)]);
        }catch (\Exception $e){
            Bugsnag::notifyException($e);
            return back();
        }
    }

    public function create(){
        try{
            $categories = Category::where('type', 3)->get();
            $podcasts = Podcast::me()->get();
            return view('episode.create', [
                'categories' => $categories,
                'podcasts' => $podcasts
            ]);
        }catch (\Exception $e){
            Bugsnag::notifyException($e);
            return redirect()->route('episodes.index');
        }
    }

    public function store(StoreEpisodeRequest $request)
    {
        try {
            $msg='Episode Store.';
            $date = date('Y-m');
            $this->entity->podcast = $request->input("podcast");
            $this->entity->title = $request->input("title");
            $this->entity->description = $request->input("description");
            $this->entity->icon = Storage::disk('liara')->put($date . '/episodes', $request->file('icon'));
            $this->entity->file = Storage::disk('liara')->put($date . '/episodes', $request->file('file'));
            $this->entity->plus = $request->input("plus");
            $this->entity->save();
           return Rest::success($msg,null);
        } catch (\Exception $e) {
           return Rest::error($e);

        }
    }
    public function play($episode){
        try{
            $msg='Episode Play.';
            $episode = Episode::findOrdFail($episode);
            $data=[
                "podcast"=>$episode->podcast,
                "file"=>$episode->file,
                "title"=> $episode->title,
                "play"=> $episode->play,
                "description"=> $episode->description,
                "icon"=> $episode->icon,
                "plus"=> $episode->plus,
                "created_at"=> $episode->created_at,
                "updated_at"=> $episode->updated_at

            ];

           return Rest::success($msg,$data);
        }catch(\Exception $e){
           return Rest::error($e);

        }

    }


    public function destroy($episode){
        try{
            $this->entity->where(['id' => $episode, 'user' => auth()->id()])->delete();
            return redirect()->route('episodes.index');
        }catch (\Exception $e){
            Bugsnag::notifyException($e);
            return back();
        }
    }

}