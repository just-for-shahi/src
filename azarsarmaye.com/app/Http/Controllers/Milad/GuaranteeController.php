<?php


namespace App\Http\Controllers\Milad;


use App\Http\Controllers\Controller;
use App\Models\Guarantee;

class GuaranteeController extends Controller
{

    private $entity;

    public function __construct()
    {
        $this->entity = new Guarantee();
    }

    public function index(){
        return view('guarantee.list', ['guarantees' => Guarantee::latest()->paginate(15)]);
    }

}
