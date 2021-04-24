<?php


namespace App\Http\Controllers\Account;


use App\Facades\Rest\Rest;
use App\Http\Controllers\Controller;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Illuminate\Http\Request;

class TeamController extends Controller
{

    private $entity;

    public function __construct()
    {
        $this->entity = new User();
    }

    public function index(){
        try{
            $msg='Team Fetched';
            $data = $this->entity->where('captain', auth('api')->id())->get();
            return Rest::success($msg,$data);
        }catch (\Exception $exception){
            Bugsnag::notifyException($exception);
         return Rest::error($exception);
        }
    }

    public function join(Request $request){
        try{
            $caption = User::where('username' , $request->caption)->first();
            if (!$caption) {
                return Rest::notFound();
            }
            $msg='You join the team';
            $this->entity->where([
                'id' => auth()->id(),
                'captain' => null
            ])->update([
                'captain' => $caption->id
            ]);
            $caption->update([
               'team' => $caption->team++
            ]);
            return Rest::success($msg,null);
        }catch (\Exception $exception){
            Bugsnag::notifyException($exception);
           return Rest::error($exception);
        }
    }

}