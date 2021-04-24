<?php


namespace Services\User\Repositories;

use Services\User\Models\User;

interface  IAutoMapperRepository
{
    public function verify(User $user): array;
    public function show(User $user): array;

    public function signUp(
        int $otp,
        ?string $password= null,
        ?int $prefix= null,
        ?string $mobile= null,
        ?string $name= null,
        ?string $email = null
    ): array;

    public function sign(
        int $otp,
        ?string $captain= null,
        ?int $prefix= null,
        ?string $mobile= null,
        ?string $name= null,
        ?string $email = null
    ): array;

    public function captain(User $user): array;
    public function verification(): array;
    public function saveVerification(array $data,string $value): array;
}
