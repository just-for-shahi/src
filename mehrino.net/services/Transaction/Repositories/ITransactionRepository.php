<?php
namespace Services\Transaction\Repositories;

use Illuminate\Http\Request;
use App\Repository\IRepository;

/**
 * Transaction
 * @author Sajadweb
 * Sun Dec 27 2020 14:05:43 GMT+0330 (Iran Standard Time)
 */
interface ITransactionRepository extends IRepository
{
    public function store($data);
    public function findAuthority($authority);
    public function createAuthority();
    public function updated($uuid,Request $request);
    public function mapper($res);
    public function paginate(int $count=15,int $page= 1,array $columns= ['*']);
}
