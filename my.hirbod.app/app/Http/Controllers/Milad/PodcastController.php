<?php


namespace App\Http\Controllers\Milad;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Podcast\Podcast;

class PodcastController extends Controller
{

    public function index(){
        try{
            $items = Podcast::latest()->paginate(15);
            return view('milad.podcasts', compact('items'));
        }catch (\Exception $e){
            return dd($e->getMessage());
        }
    }

}
