<?php

namespace App\Http\Controllers\Api;

use App\Events\OrderStateChanged;
use App\Helpers\MT4Commands;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderEquity;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function close(Request $request, int $accountNumber)
    {
        $info = $request->only('tickets');
        $rules = [
            'tickets' => 'required'
        ];
        $validator = Validator::make($info, $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->messages()]);
        }

        MT4Commands::close($accountNumber, $request['tickets']);

        return response()->json(['success' => true, 'message' => 'Close signal successfully sent to ' .$accountNumber]);
    }

    public function process(Request $request)
    {
        try {
            $object = (object)$request->except('api_token');
            event(new OrderStateChanged($object));
        } catch (\Exception $e) {
            //$this->updateApiEvent('callback', $e->getMessage());
            throw $e;
            Log::error($e);
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }

        return response()->json(['success' => true, 'message' => 'Processed: '.json_encode($object)]);
    }

    public function list(Request $request, $accountId)
    {
        $account = Account
            ::where('id', $accountId)
            ->where('user_id', $request->user()->id)->first();

        if ($account == false) {
            return response()->json(['success' => false, 'message' => 'account does not exists or does not belongs to you']);
        }

        $orders = Order::where('account_number', $account->account_number)->get();

        return response()->json(['success' => true, 'data' => $orders]);
    }

    public function equity(Request $request, $accountNumber)
    {
        return response()->json(['success' => true, 'data' => OrderEquity::whereAccountNumber($accountNumber)->get()]);
    }

    public function getUnsyncTickets(Request $request, int $accountNumber, int $limit) {
        $orders = Order
            ::whereAccountNumber($accountNumber)
            ->where( 'ticket', '>', 0)
            ->where( static function ($query) {
                $query->where('status', 0)
                    ->whereNull('type')
                    ->orWhere(static function($q) {
                        $q->where('status',3)
                        ->whereNull('pl');
                    });
            } )
            ->take($limit)
            ->pluck('ticket')
            ->toArray();

        return response()->json(['success' => true, 'data' => $orders]);
    }

    public function uploadTickets(Request $request, int $accountNumber) {
        $tickets = $request['tickets'];

        $tickets = \explode(';', $tickets);

        $values = array();
        $now = Carbon::now()->toDateTimeString();
        foreach($tickets as $ticket) {
            if(!empty($ticket))
                $values[] = '('.$accountNumber.','.$ticket.',\''.$now.'\',\''.$now.'\')';
        }

        $values = \implode(',',$values);

        if(empty($values))
            return response()->json(['success' => true, 'message' => 'uploaded. empty']);

        \DB::insert(
            "insert into `account_orders` (`account_number`, `ticket`, `created_at`,`updated_at`) values {$values} ".
            " on duplicate key update status=3"
        );

        return response()->json(['success' => true, 'message' => 'uploaded']);
    }

    public function upload(Request $request, int $accountNumber, int $ticket) {

        $order = Order::firstOrNew(['ticket'=>$ticket, 'account_number'=> $accountNumber]);

        $order->fill($request->only('ticket','account_number', 'status', 'type', 'type_str', 'pl', 'pips', 'stoploss', 'takeprofit',
        'swap', 'commission', 'symbol', 'lots', 'price_close', 'time_close', 'price', 'time_open',
        'magic', 'last_error_code', 'last_error', 'comment'));
        $order->save();

        return response()->json(['success' => true, 'message' => 'uploaded' ]);
    }
}
