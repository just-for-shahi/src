<?php


namespace App\Http\Controllers\Support;


use App\Facades\Rest\Rest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\V1\Support\Faq;

class FaqController extends Controller
{
    private $entity;


    public function __construct()
    {
        $this->entity = new Faq();

    }

    public function index()
    {
        try {
            $msg='FAQs fetched.';
            $data=[];
            $faqs = Faq::latest()->get();
            foreach ($faqs as $item)
            {
                $data[]=[
                    "uuid"=>$item->uuid,
                    "title"=> $item->title,
                    "icon"=> $item->icon === null ? null : Rest::$SARA.$item->icon,
                    "content"=> $item->content,
                ];
            }
          return Rest::success($msg,$data);
        }catch(\Exception $e) {
          return Rest::error($e);
        }
    }

}