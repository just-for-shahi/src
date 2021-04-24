<?php


namespace App\Http\Controllers\Finance;


use App\Facades\Rest\Rest;
use App\Helpers\FinanceHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BankAccountRestController extends Controller
{
    private $finance;
    private $entity;

    public function __construct()
    {
        $this->finance=new FinanceHelper();
        $this->entity = new BankAccount();
    }

    public function index(Request $request){
        try{
            $bankAccounts = BankAccount::me()->getLatest($request->get("count",15),$request->get("page",1),$request->get("search"));
            $data = [];
            foreach($bankAccounts as $item){
                $data[] = [
                    "id" => $item->id,
                    "icon" => $this->finance->getCreditCardLogo($item->card),
                    "iban" => $item->iban,
                    "card" => $item->card,
                    "account" => $item->account,
                    "status" => $item->status,
                    "created_at" => $item->jCreated,
                    "updated_at" => $item->jUpdated
                ];
            }
            return Rest::success('BankAccounts Fetched.', $data);
        }catch (\Exception $exception){
            return Rest::error($exception);
        }
    }

    public function store(BankAccountStoreRequest $request){
        try{
            $this->entity->user = auth()->id();
            $this->entity->iban = $request->input('iban');
            $this->entity->card = $request->input('card');
            $this->entity->account = $request->input('account');
            $this->entity->save();
            return Rest::success( 'BankAccount Registered.', null);
        }catch (\Exception $exception){
            return Rest::error($exception);
        }
    }
}