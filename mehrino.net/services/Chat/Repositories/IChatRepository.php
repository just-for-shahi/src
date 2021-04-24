<?php
namespace Services\Chat\Repositories;

use Services\Chat\Models\Chat;
use App\Repository\IRepository;

/**
 * Chat
 * @author Sajadweb
 * Sun Dec 27 2020 13:55:03 GMT+0330 (Iran Standard Time)
 */
interface IChatRepository extends IRepository
{
    public function preStore($service);
    public function mapper($service);
    public function mapperChat($chats);
    public function findManyChat($uuid, $paginate, $select = ["*"]);
    public function storeChat($uuid, $request);

    public function findMany(array $where , array $columns, array $paginate);
}
