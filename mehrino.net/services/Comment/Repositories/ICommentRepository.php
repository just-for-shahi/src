<?php
namespace Services\Comment\Repositories;

use Services\Comment\Models\Comment;
use App\Repository\IRepository;

/**
 * Comment
 * @author Sajadweb
 * Sun Dec 27 2020 13:51:25 GMT+0330 (Iran Standard Time)
 */
interface ICommentRepository extends IRepository
{
    public function mapper($res);
    public function show($uuid);
}
