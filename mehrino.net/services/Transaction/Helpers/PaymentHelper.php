<?php


namespace Services\Transaction\Helpers;


use App\Facades\Rest\Rest;
//use App\Http\Controllers\Account\User;
use GuzzleHttp\Client as GuzzleClient;
use Services\Transaction\Enum\Status;
use Services\Transaction\Models\Transaction;

class PaymentHelper
{
    private $guzzleClient;

    public function __construct()
    {
        set_time_limit(360000);
        ini_set("max_execution_time", 360000);
        $this->guzzleClient = new GuzzleClient([
            'verify' => false
        ]);
    }

    public static function tomansToRials($amount){
        return intval($amount.'0');
    }

    public static function rialsToTomans($amount){
        return intval(substr($amount, 0, -1));
    }

    public function pay($transaction, $callback = 'callback'){
        $transaction = Transaction::findUUID($transaction);
//        $usr = User::find($transaction['user']);
//        $result = $this->guzzleClient->post(config('hirbod.zp.url').'rest/WebGate/PaymentRequest.json', [
//            'form_params' => [
//                'MerchantID' => config('hirbod.zp.gateway'),
//                'Amount' => self::tomansToRials($transaction['amount']),
//                'CallbackURL' => route($callback),
//                'mobile' => $usr['mobile'],
//                'factorNumber' => $transaction['authority'],
//                'Description' => $transaction['description'],
//            ]
//        ]);
//        $token = json_decode($result->getBody(), true)['Authority'];
//        Transaction::where('id', $transaction['id'])->update(['authority' => $token]);
//        return config('hirbod.zp.url').'/StartPay/'.$token;

        $data = array(
            'MerchantID' => config('hirbod.zp.gateway'),
            'Amount' => $transaction['amount'],
            'CallbackURL' => route($callback),
            'Description' => $transaction['description']
        );
        $jsonData = json_encode($data);
        $ch = curl_init('https://www.zarinpal.com/pg/rest/WebGate/PaymentRequest.json');
        curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v1');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData)
        ));
        $result = curl_exec($ch);
        $err = curl_error($ch);
        $result = json_decode($result, true);
        curl_close($ch);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            if ($result["Status"] == 100) {
                Transaction::where('id', $transaction['id'])->update(['authority' => $result['Authority']]);
                return 'Location: https://www.zarinpal.com/pg/StartPay/' . $result["Authority"];
            } else {
                echo'ERR: ' . $result["Status"];
            }
        }
    }

    public function payRest($transaction, $callback = 'callback'){
        $transaction = Transaction::findUUID($transaction);
//        $usr = User::find($transaction['user']);
//        $result = $this->guzzleClient->post(config('hirbod.zp.url').'rest/WebGate/PaymentRequest.json', [
//            'form_params' => [
//                'MerchantID' => config('hirbod.zp.gateway'),
//                'Amount' => self::tomansToRials($transaction['amount']),
//                'CallbackURL' => route($callback),
//                'mobile' => $usr['mobile'],
//                'factorNumber' => $transaction['authority'],
//                'Description' => $transaction['description'],
//            ]
//        ]);
//        $token = json_decode($result->getBody(), true)['Authority'];
//        Transaction::where('id', $transaction['id'])->update(['authority' => $token]);
//        return config('hirbod.zp.url').'/StartPay/'.$token;

        $data = array(
            'MerchantID' => config('mehrino.zp.gateway'),
            'Amount' => $transaction['amount'],
            'CallbackURL' => config('mehrino.zp.callbackUrl'),
            'Description' => $transaction['description']
        );
        $jsonData = json_encode($data);
        $ch = curl_init('https://www.zarinpal.com/pg/rest/WebGate/PaymentRequest.json');
        curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v1');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData)
        ));
        $result = curl_exec($ch);
        $err = curl_error($ch);
        $result = json_decode($result, true);
        curl_close($ch);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            if ($result["Status"] == 100) {
                Transaction::where('id', $transaction['id'])->update(['authority' => $result['Authority']]);
                return 'https://www.zarinpal.com/pg/StartPay/' . $result["Authority"];
            } else {
                echo'ERR: ' . $result["Status"];
            }
        }
    }

    public function verify($Authority){
        try{
            $transaction = Transaction::where('authority', $Authority)->first();
            if ($transaction != null){
                $data = array('MerchantID' => config('hirbod.zp.gateway'), 'Authority' => $Authority, 'Amount' => $transaction->amount);
                $jsonData = json_encode($data);
                $ch = curl_init('https://www.zarinpal.com/pg/rest/WebGate/PaymentVerification.json');
                curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v1');
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($jsonData)
                ));
                $result = curl_exec($ch);
                $err = curl_error($ch);
                curl_close($ch);
                $result = json_decode($result, true);
                return $result;
                if ($err) {
                    echo "cURL Error #:" . $err;
                } else {
                    if ($result['Status'] == 100) {
                        Transaction::where('authority', $token)->update([
                            'card_number' => $result['CardNumber'],
                            'trace_number' => $result['RefID'],
                            'status' => Status::PAID
                        ]);
                        return true;
                    } else {
                        echo 'Transation failed. Status:' . $result['Status'];
                        return false;
                    }
                }
//                $result = $this->guzzleClient->post(config('hirbod.zp.url').'verify', [
//                    'form_params' => [
//                        'MerchantID' => config('hirbod.zp.gateway'),
//                        'token' => $token,
//                    ]
//                ]);
//                $result = json_decode($result);
//                if (intval($result->status) === 1 && self::rialsToTomans($result->amount) === $transaction['amount']){
//                    Transaction::where('authority', $token)->update([
//                        'card_number' => $result->cardNumber,
//                        'trace_number' => $result->transId,
//                        'status' => Status::PAID
//                    ]);
//                    return true;
//                }
            }
        }catch (\Exception $e){
            Rest::error($e);
        }
        return false;
    }
}
