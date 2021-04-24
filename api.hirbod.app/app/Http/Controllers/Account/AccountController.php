<?php


namespace App\Http\Controllers\Account;


use App\Events\Email;
use App\Facades\Rest\Rest;
use App\Helpers\CommonHelper;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Event\Event;
use App\Http\Controllers\Finance\Transaction;
use App\Listeners\SendEmail;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Morilog\Jalali\Jalalian;
use PHPUnit\Util\Filesystem;

class AccountController extends Controller
{
    private $entity;

    public function __construct()
    {
        $this->entity = new User();
    }


    public function show(){
        try{
            $msg='Profile Fetched';
            $user = $this->entity->whereId(auth('api')->id())->first();
            if ($user === null){
                return Rest::notFound();
            }
            $team = User::where('captain', $user->id)->get()->count();
            $purchases = Transaction::where(['user' => $user->id, 'status' => 1])->get()->count();
            $ucoins = random_int(12,8392);
            $data=[
                "name"=> $user->name,
                "mobile"=> $user->country.$user->mobile,
                "username"=> $user->username,
                "balance"=> $user->balance,
                "blueTick"=> CommonHelper::checkBoolean($user->blue),
                "status"=> intval($user->status),
                "plus"=> $user->plus,
                'avatar' => Rest::tempUrl($user->avatar),
                'team' => $team,
                'purchases' => $purchases,
                'lastConnection' => Jalalian::forge($user->last_connection)->ago(),
                'ucoins' => $ucoins,
                "email"=> $user->email,
                "createdAt"=>$user->jCreated,
                "updatedAt"=>$user->jUpdated,
            ];
            return Rest::success($msg,$data);
        }catch (\Exception $exception){
            return Rest::error($exception);
        }
    }

    public function update(Request $request){
        try {

            $validatior = Validator::make($request->all() , [
                'name' => 'sometimes|nullable|string|max:255',
                'username' => 'sometimes|nullable|string|max:255',
                'email' => 'sometimes|nullable|email|max:255',
            ]);

            if ($validatior->fails()) {
                return Rest::badRequest($validatior->errors());
            }

            $msg='Profile Updated.';

            $user=$this->entity->whereId(auth('api')->id())->first();
            if ($user === null){
                return Rest::notFound();
            }

            $update = $user->update([
                'name' => $request->name ?? $user->name,
                'username' => $request->username ?? $user->username,
                'email' => $request->email ?? $user->email,
            ]);

            if (isset($request->email)) {
                $user->update([
                    'status' => 0
                ]);
            }

//            $data = [];
//            if ($request->has('username') && !is_null(trim($request->input('username')))) {
//                return 'username';
//                $data['username'] = $request->input('username');
//            }
//            if ($request->has('name') && !is_null(trim($request->input('name')))) {
//                $data['name'] = $request->input('name');
//            }
//            if ($request->has('email') && !is_null(trim($request->input('email'))) && $user->email!=$request->input('email')) {
//                $data['email'] = trim($request->input('email'));
//            }
//            if ($request->hasFile('avatar') && !is_null($request->file('avatar'))) {
//                if(is_null($user->avatar)){
//                    $file= Storage::put('avatars/'.$user->uuid, $request->avatar);
//                    $data['avatar'] =getHashName($file);
//                }else{
//                     Storage::delete('avatars/'.$user->uuid."/". $user->avatar);
//                    $data['avatar'] =null;
//                    $file= Storage::put('avatars/'.$user->uuid, $request->avatar);
//                    $data['avatar'] =getHashName($file);
//                }
//            }
//            if($request->has('email') && !is_null(trim($request->input('email'))) && $user->email!=$request->input('email')){
//
//                $user->update(['status'=>0]);
//            }


//            if($request->has('email') && !is_null(trim($request->input('email'))) && $user->email!=$request->input('email')){
//
//                $user=$this->entity->whereId(auth('api')->id())->first();
//                \event(new Email($user));
//            }


            if($update){
                return Rest::success($msg,null);
            }
            else{
                return Rest::badRequest();
            }
        } catch (\Exception $exception) {
            return Rest::error($exception);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function avatar(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all() , [
                'avatar' => 'required|image|max:5120'
            ]);

            if ($validator->fails()) {
                return Rest::badRequest($validator->errors());
            }

            $user = auth('api')->user();
            $prev_file = $user->avatar;

            $file = $request->file('avatar');

            $id = auth('api')->id();
            $username = $user->username;

            $msg = 'Avatar Uploaded Successfully';
            $name = "public/upload/images/avatars/{$id}_{$username}/{$file->getClientOriginalName()}";
            $file_name = $file->store($name);

            $user->update([
                'avatar' => $file_name
            ]);

            if ($user->avatar !== null && Storage::exists($user->avatar)) {
                Storage::delete($prev_file);
                $msg = 'Avatar Updated Successfully';
            }

            $data = [
                'avatar' => $file_name
            ];

            return Rest::success($msg , $data);

        } catch (\Exception $e) {
            return Rest::error($e);
        }
    }

}