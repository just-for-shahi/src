<?php
namespace Services\Post\Repositories;

use Services\Post\Models\Post;
use App\Repository\IRepository;

/**
 * Post
 * @author Sajadweb
 * Sun Jan 24 2021 14:52:20 GMT+0330 (Iran Standard Time)
 */
interface IPostRepository extends IRepository
{
    public function store(array $data);
    public function updateAll($data , $weblog);
    public function destroyAll($weblog);
}
