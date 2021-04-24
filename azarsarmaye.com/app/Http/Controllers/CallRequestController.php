<?php


namespace App\Http\Controllers;



use App\Enums\SMSTemplate;
use App\Enums\SMSType;
use App\Http\Requests\CallRequestStoreRequest;
use App\Jobs\SendSMS;
use App\Models\CallRequest;
use Illuminate\Routing\Route;

class CallRequestController extends Controller
{

    private $obj;

    public function __construct(){
        $this->obj = new CallRequest();
    }

    public function index()
    {
        try{
            $items = CallRequest::me()->latest()->paginate(15);
            return view('call-requests.index', compact('items'));
        }catch (\Exception $e){
            return dd($e->getMessage());
        }
    }

    public function store(CallRequestStoreRequest $r){
        try{
            $this->obj->user = auth()->id();
            $this->obj->name = $r->input('name');
            $this->obj->phone = $r->input('phone');
            $this->obj->status = 0;
            $this->obj->save();
            SendSMS::dispatch(SMSType::MILAD, config('mana.milad.mobile'), 'ثبت درخواست تماس', SMSTemplate::MILAD);
            if (url()->previous() === \route('index').'/'){
                return redirect()->route('index');
            }else{
                return redirect()->route('callRequests.index');
            }
        }catch (\Exception $e){
            return dd($e->getMessage());
        }
    }
}
