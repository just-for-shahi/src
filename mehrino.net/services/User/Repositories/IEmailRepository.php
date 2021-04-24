<?php


namespace Services\User\Repositories;


interface IEmailRepository
{
    public function otp(int $otp= 0): int;
    public function commit(string $value);
    public function abort();
}
