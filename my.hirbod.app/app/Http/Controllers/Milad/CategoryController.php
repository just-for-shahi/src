<?php


namespace App\Http\Controllers\Milad;


use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index(){
        try{
            $items = Category::latest()->paginate(15);
            return view('milad.categories', compact('items'));
        }catch (\Exception $e){
            return dd($e->getMessage());
        }
    }

    public function store(Request $r){
        try{
            $data = [];
            $r->has('name') ? $data['name'] = $r->input('name') : false;
            $r->has('color') ? $data['color'] = $r->input('color') : false;
            $r->hasFile('photo') ? $data['photo'] = $r->file('photo')->store(date('Y-m').'/categories') : false;
            Category::where('id', $r->input('category'))->update($data);
        }catch (\Exception $e){
            return dd($e);
        }
        return  redirect()->route('mcategories.index');
    }

}
