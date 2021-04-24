<?php
namespace Services\Story\Repositories;

use Illuminate\Http\Request;
use Services\Story\Models\Story;
use App\Repository\IRepository;

/**
 * Story
 * @author Sajadweb
 * Fri Dec 25 2020 02:41:53 GMT+0330 (Iran Standard Time)
 */
interface IStoryRepository extends IRepository
{
    public function save(Request $request);
    public function updated($uuid,Request $request);
    public function mapper($res);
    public function mapperUser($res);
    public function paginate(int $count=15,int $page= 1,array $columns= ['*']);
    public function paginateUser(int $count=15,int $page= 1,array $columns= ['*']);
}
