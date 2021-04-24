<?php

namespace Services\User\Repositories;

use App\Enums\SMSTemplate;
use App\Enums\SMSType;
use App\Jobs\SendSMS;

class SmsRepository implements ISmsRepository
{


    private $otp;
    private $typeOtp = 'sms';
    public function otp(int $otp=0): int
    {
        if($otp!== 0){
            $this->otp= $otp;
        }else{
            $this->otp = random_int(1000, 9999);
        }
       return $this->otp;
    }
    public function setTypeOtp(string $typeOtp='sms'): void
    {
        $this->typeOtp = $typeOtp;
    }

    public function commit($mobile):void
    {
          SendSMS::dispatch(SMSType::AUTH,$mobile, $this->otp, SMSTemplate::VERIFY,$this->typeOtp)->onQueue('high');
    }

    public function abort()
    {
        $this->otp = '';
    }
}
