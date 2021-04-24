<?php


namespace App\Http\Controllers\Finance;


use App\Facades\Rest\Rest;
use App\Helpers\FinanceHelper;
use App\Http\Controllers\Controller;
//use App\Http\Requests\Finance\CreditStoreRequest;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Illuminate\Http\Request;

class CreditController extends Controller
{

    private $entity;
    private $finance;

    public function __construct()
    {
        $this->entity = new Credit();
        $this->finance = new FinanceHelper();
    }

    public function index(Request $request){
        try{
            $msg="Credits Fetched.";
            $credits = $this->entity->has("me")
                ->lastest()
                ->paginate($request->input("count", 15), ['*'], $request->input("page", 1));
            $data = [];
            foreach ($credits as $item){
                $data[] = [
                    'id' => $item->id,
                    'uuid' => $item->uuid,
                    'credit' => $item->credit,
                    'title' => $this->finance->creditTypes($item->type),
                    'description' => $item->description,
                    'status' => $item->status,
                    'created_at' => $item->jCreated,
                    'updated_at' => $item->jUpdated
                ];
            }
          return Rest::success($msg,$data);
        }catch (\Exception $exception){
            Bugsnag::notifyException($exception);
            return Rest::error($exception);
        }
    }

//    public function store(CreditStoreRequest $request){
    public function store(Request $request){

    }

}