<?php

namespace App\Http\Controllers\Api;

use Hash;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Account;
use App\Models\Order;
use App\Models\BrokerSymbol;
use App\Models\BrokerGroup;
use App\Models\BrokerUser;

class BrokerManagerController extends Controller
{
    public function process(Request $request, $broker_id, $api_server_id)
    {
        try {
            $json_str = file_get_contents('php://input');
            //echo $json_str;

            if (empty($json_str)) {
                throw new \Exception('POST is empty');
            }

            $object = json_decode($json_str);

            $jsonError = json_last_error();

            //In some cases, this will happen.
            if (is_null($object) && $jsonError == JSON_ERROR_NONE) {
                throw new \Exception('Could not decode JSON!');
            }

            //If an error exists.
            if ($jsonError != JSON_ERROR_NONE) {
                $error = 'Could not decode JSON! ';

                //Use a switch statement to figure out the exact error.
                switch ($jsonError) {
                    case JSON_ERROR_DEPTH:
                        $error .= 'Maximum depth exceeded!';
                    break;
                    case JSON_ERROR_STATE_MISMATCH:
                        $error .= 'Underflow or the modes mismatch!';
                    break;
                    case JSON_ERROR_CTRL_CHAR:
                        $error .= 'Unexpected control character found';
                    break;
                    case JSON_ERROR_SYNTAX:
                        $error .= 'Malformed JSON';
                    break;
                    case JSON_ERROR_UTF8:
                        $error .= 'Malformed UTF-8 characters found!';
                    break;
                    default:
                        $error .= 'Unknown error!';
                    break;
                }
                throw new \Exception($error);
            }

            $this->_process($object, $broker_id, $api_server_id);
        } catch (\Exception $e) {
            //$this->updateApiEvent('callback', $e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }

        return response()->json(['success' => true, 'message' => 'Processed: '.$json_str]);
    }

    private function _process($object, $broker_id, $api_server_id)
    {
        switch ($object->type) {
            case 'user':
                $this->_processAccount($object->object, $broker_id, $api_server_id);
                break;
            case 'order':
                $this->_processOrder($object->object);
                break;
            case 'symbol':
                $this->_processSymbol($object->object);
                break;
            case 'group':
                $this->_processGroup($object->object);
                break;
        }

        //$this->updateApiEvent('callback_'.$object->type);
    }

    private function _processSymbol($symbol)
    {
        BrokerSymbol::updateOrCreate(['name' => $symbol->name], ['spread' => $symbol->spread]);
    }

    private function _processGroup($group)
    {
        BrokerGroup::updateOrCreate(['name' => $group->name], ['name' => $group->name]);
    }

    private function _processOrder($order)
    {
        Order::updateOrCreate(
            ['ticket' => $order->ticket],
            ['account_number' => $order->login,
            'status' => $order->state,
            'type' => $order->type,
            'type_str' => $order->type_str,
            'pl' => $order->profit,
            'pips' => $order->pips,
            'stoploss' => $order->sl,
            'takeprofit' => $order->tp,
            'swap' => $order->swap,
            'commission' => $order->commission,
            'symbol' => $order->symbol,
            'lots' => $order->lots,
            'price_close' => $order->close_price,
            'time_close' => $order->close_time_str,
            'price' => $order->open_price,
            'time_open' => $order->open_time_str,
        ]
        );
    }

    private function _processAccount($account, $broker_id, $api_server_id)
    {
        $user = User::updateOrCreate(
            ['email'=>$account->email],
            ['name' => $account->name, 'username' => $account->email, 'password' => Hash::make($account->email) ]
        );
        $brokerUser = BrokerUser::updateOrCreate(
            ['user_id'=>$user->id],
            ['group'=>$account->group, 'reg_date' => $account->reg_date_str]
        );
        Account::updateOrCreate(
            ['user_id' => $user->id, 'account_number' => $account->login],
            ['name' => $account->name,'balance' => $user->balance, 'broker_server_id'=> $broker_id, 'api_server_id' => $api_server_id]
        );
    }
}
