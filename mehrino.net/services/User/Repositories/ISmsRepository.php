<?php


namespace Services\User\Repositories;


interface ISmsRepository
{
    public function otp(int $otp= 0): int;
    public function setTypeOtp(string $otp): void;
    public function commit($mobile);
    public function abort();
}
