<?php


namespace App\Http\Controllers\Podcast;


use App\Http\Requests\StoreEpisodeRequest;
use Illuminate\Http\Request;

class EpisodController extends \App\Http\Controllers\Controller
{

    private $model;

    public function __construct()
    {
        $this->model = new Episode();
    }

//    public function store(StoreEpisodeRequest $r){ // @TODO: Fix validation issue
    public function store(Request $r){
        try{
            $this->model->podcast = $r->input('podcast');
            $this->model->title = $r->input('title');
            $this->model->description = $r->input('description');
            $this->model->file = $r->file('file')->store(date('Y-m').'/podcasts/episods');
            $this->model->plus = $r->input('plus');
            $this->model->plays = 0;
            $this->model->status = 1;
            $this->model->save();
        }catch (\Exception $e){
            return dd($e->getMessage());
        }
        return redirect()->route('podcasts.index');
    }

}
