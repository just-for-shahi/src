<?php

namespace Services\User\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Services\User\Repositories\IAutoMapperRepository;
use Services\User\Repositories\IUserRepository;
use Services\User\Requests\UserRequests;
use Services\User\Response\ResUserShow;
use Services\User\Response\ResUserShowProfile;

/**
 * User
 * @author Sajadweb
 * Mon Dec 07 2020 23:16:28 GMT+0330 (Iran Standard Time)
 */
class UserController extends Controller
{
    protected $account;
    protected $mapper;

    public function __construct(IUserRepository $account,
                                IAutoMapperRepository $mapper
    )
    {
        $this->account = $account;
        $this->mapper = $mapper;
    }

    public function health()
    {

        return Ok([
            'health' => Carbon::now(),
            'db' => DB::getDefaultConnection(),
            'redis' => 'No'
        ]);
    }

    public function show()
    {
        try {
            $user = $this->account->me();
            return OK(mapper(new ResUserShow(), $user, function ($res) use ($user) {
                $res['avatar'] = getBaseUri($res['avatar']);
                $res['posts'] = $user->projects()->count()+
                    $user->voluntary()->count()+
                    $user->wall()->count();
                $res['followers'] = $user->follows()->count();
                return $res;
            }));
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }

    public function showUser($uuid)
    {
        try {
            $user = $this->account->db()->with('isFollow')->where('uuid', $uuid)->first();
            if (!$uuid) return NotFound404();
            return OK(mapper(new ResUserShowProfile(), $user, function ($res) use ($user) {
                $res['avatar'] = getBaseUri($res['avatar']);
                $res['posts'] = $user->projects()->whereStatus(config('mehrino.default_status.show'))->count()+
                    $user->voluntary()->whereStatus(config('mehrino.default_status.show'))->count()+
                    $user->wall()->whereStatus(config('mehrino.default_status.show'))->count();
                $res['followers'] = $user->follows()->count();
                $res['is_follow'] = !(!$user->isFollow);
                return $res;
            }));
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }

    public function store(UserRequests $request)
    {
        try {
          return  $this->account->meUpdate($request);
            return Ok();
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }

}
