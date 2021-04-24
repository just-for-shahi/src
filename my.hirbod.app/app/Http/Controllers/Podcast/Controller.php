<?php


namespace App\Http\Controllers\Podcast;


use App\Http\Requests\StorePodcastRequest;
use App\Http\Requests\UpdatePodcastRequest;
use App\Models\Category;
use App\Models\Price;
use App\Models\Tag;

class Controller extends \App\Http\Controllers\Controller
{

    private $model, $episode;

    public function __construct()
    {
        $this->model = new Podcast();
        $this->episode = new Episode();
    }

    public function index(){
        try{
            $items = Podcast::me()->latest()->paginate(15);
            return view('podcasts.index', compact('items'));
        }catch (\Exception $e){
            return dd($e);
        }
    }

    public function create(){
        try{
            $cats = Category::where('type', 2)->get();
            return view('podcasts.new', compact('cats'));
        }catch (\Exception $e){
            return dd($e->getMessage());
        }
    }

    public function store(StorePodcastRequest $r){
        try{
            $date = date('Y-m');
            $this->model = Podcast::create([
                'user' => auth()->id(),
                'title' => $r->input('title'),
                'logo' => $r->file('logo')->store($date.'/podcasts/logos'),
                'cover' => $r->file('cover')->store($date.'/podcasts/covers'),
                'description' => $r->input('description'),
                'website' => $r->input('website'),
                'status' => 1
            ]);
            $this->model->categories()->sync($r->input('category'), false);
            $tags = explode('-', $r->input('tags'));
            foreach ($tags as $tag){
                $tag = Tag::updateOrCreate([
                    'name' => rtrim(ltrim($tag))
                ]);
                $this->model->tags()->sync($tag->id, false);
            }
            if ($r->has('price')){
                Price::create([
                    'price' => $r->input('price'),
                    'special_price' => $r->input('special-price'),
                    'pricable_type' => Podcast::class,
                    'pricable_id' => $this->model->id
                ]);
            }
        }catch (\Exception $e){
            return dd($e->getMessage());
        }
        return redirect()->route("podcasts.index");
    }

    public function destroy($podcast){
        try{
            $this->model->where(['id' => $podcast, 'user' => auth()->id()])->delete();
        }catch (\Exception $e){
            return dd($e->getMessage());
        }
        return redirect()->route('podcasts.index');
    }

    public function episodes($uuid){
        try{
            $podcast = Podcast::where(['uuid' => $uuid, 'user' => auth()->id()])->first();
            if ($podcast === null){
                return abort(404);
            }
            $items = Episode::where('podcast', $podcast['id'])->latest()->paginate(15);
            return view('podcasts.episodes', compact('podcast', 'items'));
        }catch (\Exception $e){
            return dd($e);
        }
    }

    public function episodeDestroy($uuid){
        try{
            $podcast = Episode::where('uuid', $uuid)->first();
            if ($podcast === null){
                return abort(404);
            }
            $this->episode->where('uuid', $uuid)->delete();
        }catch (\Exception $e){
            return dd($e->getMessage());
        }
        return redirect()->route('podcasts.episodes', ['uuid' => $podcast['podcast']]);
    }

    public function show($uuid){
        try{
            $podcast = Podcast::where('uuid', $uuid)->me()->with('tags', 'categories', 'episodes', 'prices')->first();
            if ($podcast === null){
                return abort(404);
            }
            return view('podcasts.show', compact('podcast'));
        }catch (\Exception $e){
            return dd($e->getMessage());
        }
    }

    public function update($uuid, UpdatePodcastRequest $r){
        try{
            $data = [
                'title' => $r->input('title'),
                'description' => $r->input('description'),
                'website' => $r->input('website'),
            ];
            if ($r->hasFile('logo')){
                $data['logo'] = $r->file('logo')->store(date('Y-m').'/podcasts');
            }
            if ($r->hasFile('cover')){
                $data['cover'] = $r->file('cover')->store(date('Y-m').'/podcasts');
            }
            Podcast::where('uuid', $uuid)->update($data);
            return redirect()->route('podcasts.index');
        }catch (\Exception $e){
            return dd($e);
        }
    }

}
