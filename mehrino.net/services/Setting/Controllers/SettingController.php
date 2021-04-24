<?php
namespace Services\Setting\Controllers;

use App\Http\Controllers\Controller;
use Services\Setting\Models\Setting;
use Services\Setting\Repositories\ISettingRepository;
use Services\Setting\Requests\SettingRequest;
use Services\User\Models\User;

/**
 * Setting
 * @author Sajadweb
 * Fri Dec 25 2020 02:40:53 GMT+0330 (Iran Standard Time)
 */
class SettingController extends Controller{

    private $repository;
    public function __construct(ISettingRepository $repository){
        // todo add repo
        $this->repository = $repository;
    }

    public function index()
    {
        try {
            $user = auth()->user();
            if (!$user->setting) {
                return Ok($this->repository->add($user->id));
            }
            return Ok($user->setting);
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }

    public function update(SettingRequest $request)
    {
        try {
            $user = auth()->user();
            if (!$user->setting) {
                 $this->repository->add(auth()->id);
            } else {
                $this->repository->up($user, $request->toArray());
            }
            return Ok();
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }

}
