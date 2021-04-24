<?php
namespace Services\User\Repositories;

use Services\User\Models\User;
use App\Repository\IRepository;

/**
 * User
 * @author Sajadweb
 * Mon Dec 07 2020 23:16:28 GMT+0330 (Iran Standard Time)
 */
interface IUserRepository extends IRepository
{
    public function all();
    public function splitMobile($value): ?array;
    public function findMobile(int $mobile): ?User;
    public function findEmail(string $email): ?User;
    public function findId(int $id): ?User;
    public function findUsername(string $username): ?User;
    public function createToken(User $account): string;
    public function insert(array $data): User;
    public function findInsert($emailOrMobile): ?User;
    public function insertWithMobileOrEmail($email,$mobile);
    public function query();
    public function me();
    public function meUpdate($request);
    public function findUUID($uuid);
    public function updateProfile($request);
}
