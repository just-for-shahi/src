<?php


namespace App\Http\Controllers\Podcast;


use App\Http\Controllers\Controller;
use App\Http\Requests\StorePodcastRequest;
use App\Models\Category;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Illuminate\Support\Str;

class PodcastController extends Controller
{


    private $entity;

    public function __construct()
    {

        $this->entity = new Podcast();
    }

    public function index(){
        try{
            return view('podcast.list', ['podcasts' => Podcast::where('user', auth()->id())->latest()->paginate(15)]);
        }catch (\Exception $e){
            Bugsnag::notifyException($e);
            return back();
        }
    }

    public function create(){
        try{
            $categories = Category::where('type', 2)->get();
            return view('podcast.create', [
                'categories' => $categories,
            ]);
        }catch (\Exception $e){
            Bugsnag::notifyException($e);
            return redirect()->route('podcasts.index');
        }
    }
    public function store(StorePodcastRequest $request){
        try{
            $date = date('Y-m');
            $this->entity->code=Str::random(6);
            $this->entity->user=auth()->id();
            $this->entity->name=$request->input("name");
            $this->entity->logo=$request->file("logo")->store($date.'/podcasts/logos/');
            $this->entity->cover=$request->file("cover")->store($date.'/podcasts/covers/');
            $this->entity->description=$request->input("description");
            $this->entity->website=$request->input("website");
            $this->entity->save() ;
        }catch (\Exception $e){
            Bugsnag::notifyException($e);
        }
        return redirect()->route("podcasts.index");
    }

    public function destroy($podcast){
        try{
            $this->entity->where(['id' => $podcast, 'user' => auth()->id()])->delete();
            return redirect()->route('podcasts.index');
        }catch (\Exception $e){
            Bugsnag::notifyException($e);
            return back();
        }
    }

}