<?php


namespace Services\User\Repositories;

use Services\Email\Jobs\SendEmail;

class EmailRepository implements IEmailRepository
{
    private $otp;

    public function otp(int $otp = 0): int
    {
        if ($otp !== 0) {
            $this->otp = $otp;
        } else {
            $this->otp = random_int(1000, 9999);
        }
        return $this->otp;
    }

    public function commit(string $email)
    {
      return SendEmail::dispatch($email,$this->otp)->onQueue('high');
    }

    public function abort()
    {
        // TODO: Implement abort() method.
    }
}
