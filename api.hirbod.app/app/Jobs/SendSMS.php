<?php

namespace App\Jobs;

use App\Enums\SMS\Type;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendSMS implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $type, $mobile, $msg, $template, $mode;

    /**
     * Create a new job instance.
     *
     * @param $type
     * @param $mobile
     * @param $msg
     * @param $template
     * @param string $mode
     */
    public function __construct($type, $mobile, $msg, $template, $mode="sms")
    {
        $this->type = $type;
        $this->mobile = $mobile;
        $this->msg = $msg;
        $this->template = $template;
        $this->mode = $mode;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try{
            switch ($this->type){
                case Type::GENERAL:
                default:
                    $this->simple($this->mobile, $this->msg);
                    break;
                case Type::AUTH:
                case Type::CAMPAIGN:
                case Type::FINANCE:
                case Type::NOTIFICATION:
                case Type::TEMPLATE:
                    $this->temp($this->mode, $this->mobile, $this->msg, $this->template);
                    break;
            }
        }catch (\Exception $e){
            Bugsnag::notifyException($e);
        }
    }

    /**
     * @param $type
     * @param $mobile
     * @param $code
     * @param $template
     * @return bool
     */
    public function temp($type, $mobile, $code, $template){
        $client = new Client();
        $response = $client->post('https://api.kavenegar.com/v1/'.config('hirbod.sms.key').'/verify/lookup.json?type='.$type.'&receptor='.$mobile.'&token='.$code.'&template='.$template);
        $body = \GuzzleHttp\json_decode($response->getBody(), true);
        if ($body['return']['status'] == 200){
            return true;
        }
        return false;
    }

    /**
     * @param $mobile
     * @param $text
     * @return bool
     */
    public function simple($mobile, $text){
        $client = new Client();
        $url='https://api.kavenegar.com/v1/'.config('hirbod.sms.key').'/sms/send.json';
        $response = $client->post($url.'?receptor='.$mobile.'&message='.$text);
        $body = \GuzzleHttp\json_decode($response->getBody(), true);
        if ($body['return']['status'] == 200){
            return true;
        }
        return false;
    }
}
