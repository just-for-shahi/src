<?php


namespace Services\User\Repositories;


use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Services\User\Enum\VerifiedType;
use Services\User\Models\User;
use Services\User\Repositories\IUserRepository;

class AutoMapperRepository implements IAutoMapperRepository
{

    protected $user;

    public function __construct(IUserRepository $user)
    {
        $this->user = $user;

    }

    public function verify(User $user): array
    {
        return [
            'uuid' => $user->uuid,
            'token' => $this->user->createToken($user),
            'mobile' => $user->mobile,
            'prefix_mobile' => $user->prefix_mobile,
            'email' => $user->email,
            'name' => $user->name,
            'avatar' => $user->avatar === null ? null : getBaseUri($user->avatar),
            'username' => makeUsername($user->username),
            "team" => intval($user->team),
            'captain' => $user->captain,
            'ucoins' => $user->ucoins,
            'balance' => $user->balance,
        ];
    }

    public function show(User $user): array
    {
        return [
            'uuid' => $user->uuid,
            'mobile' => $user->mobile,
            'prefix_mobile' => $user->prefix_mobile,
            'email' => $user->email,
            'name' => $user->name,
            'avatar' => $user->avatar === null ? null : getBaseUri($user->avatar),
            'username' => makeUsername($user->username),
            "team" => intval($user->team),
            "level" => $user->level,
            'captain' => $user->captain,
            'ucoins' => $user->ucoins,
            'balance' => $user->balance,
            'createdAt' => $user->jCreated,
            'updatedAt' => $user->jUpdated
        ];
    }

    public function signUp(
        int $otp,
        ?string $password = null,
        ?int $prefix = null,
        ?string $mobile = null,
        ?string $name = null,
        ?string $email = null
    ): array
    {
        $addMinutes = 300;
        return [
            'country' => $prefix,
            'mobile' => $mobile,
            'code' => $otp,
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            "username" => Str::random(6),
            'code_expire' => now()->addMinutes($addMinutes)
        ];
    }
    public function sign(
        int $otp,
        ?string $captain = null,
        ?int $prefix = null,
        ?string $mobile = null,
        ?string $name = null,
        ?string $email = null
    ): array
    {
        $addMinutes = 3;
        return [
            'country' => $prefix,
            'mobile' => $mobile,
            'code' => $otp,
            'name' => $name,
            'email' => $email,
            'captain' => $captain,
            "username" => Str::random(6),
            'code_expire' => now()->addMinutes($addMinutes)
        ];
    }

    public function captain(user $user): array
    {
        return array(
            'name' => $user['name'],
            'username' => $user['username'],
            'photo' => $user->avatar === null ? null : getBaseUri($user['avatar']),
            'joined' => $user->jCreated,
            'lastConnection' => $this->persian->datetime($user['last_connection'])
        );
    }

    public function verification(): array
    {
        return array(
            "type",
            "label",
            "value",
            "verified",
            "description",
        );
    }

    public function saveVerification(array $data, $value): array
    {
        return array(
            'user' => auth()->id(),
            'label' => $data['label'],
            'type' => $data['type'],
            'value' => $value,
            'description' => null,
            'verified' => VerifiedType::PENDING
        );
    }
}
