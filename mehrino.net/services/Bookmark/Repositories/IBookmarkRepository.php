<?php
namespace Services\Bookmark\Repositories;

use Services\Bookmark\Models\Bookmark;
use App\Repository\IRepository;

/**
 * Bookmark
 * @author Sajadweb
 * Sat Jan 09 2021 19:57:43 GMT+0330 (Iran Standard Time)
 */
interface IBookmarkRepository extends IRepository
{
    public function paginate(int $count=15,int $page= 1,array $columns= ['*']);
    public function mapper($results);

}
