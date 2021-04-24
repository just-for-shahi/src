<?php

namespace Services\User\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Services\User\Models\User;
use App\Repository\Repository;
use Services\Attachment\Repositories\IAttachmentRepository;
use Services\User\Response\ReqUser;
use Illuminate\Support\Str;

/**
 * User
 * @author Sajadweb
 * Mon Dec 07 2020 23:16:28 GMT+0330 (Iran Standard Time)
 */
class UserRepository extends Repository implements IUserRepository
{
    /**
     * The model being queried.
     *
     * @var User
     */
    public $model;

    public function __construct(User $model)
    {
        $this->model = $model::query();
    }


    public function all()
    {
        // TODO: Implement all() method.
        return $this->model->paginate();
    }

    public function findMobile(int $mobile): ?User
    {
        return $this->model->where('mobile', $mobile)->first();
    }

    public function splitMobile($value): ?array
    {
        $prefix = substr($value, 0, strlen($value) - 10);
        $mobile = substr($value, strlen($value) - 10, 10);
        return [$prefix, $mobile];
    }

    public function findEmail(string $email): ?User
    {
        return $this->model->where('email', $email)->first();
    }

    public function findId(int $id): ?User
    {
        return $this->model->findOrFail($id);
    }

    public function findUsername(string $username): ?User
    {
        return $this->model->where('username', $username)->first();
    }

    public function findInsert($emailOrMobile): ?User
    {
        if (preg_match('/^[0-9]{1,4}[0-9]{10}$/u', $emailOrMobile)) {
            [$prefix, $mobile] = $this->splitMobile($emailOrMobile);
            $user = $this->model->where('mobile',  $mobile)->first();
            if (!$user) {
                $user = $this->insert([
                    'country' => $prefix,
                    'mobile' => $mobile,
                    "username" => Str::random(6)
                ]);
            }
        } else {
            $user = $this->model->where('email', $emailOrMobile)->first();
            if (!$user) {
                $user = $this->insert([
                    'email' => $emailOrMobile,
                    "username" => Str::random(6)
                ]);
            }
        }
        if ($user)
            return $user;
        else
            return auth('web')->user();
    }
    public function insertWithMobileOrEmail($email, $mobile, $data = [])
    {
        if (!$email && !$mobile) {
            alert(__('message.user.add.title'), __('message.user.add.error'), 'error');
            return null;
        }

        if ($mobile) {
            [$prefix, $phone] = $this->splitMobile($mobile);
            $user = $this->model->where('mobile', $phone)->first();
            if ($user) {
                alert(__('message.user.add.title'), __('message.user.add.error'), 'error');
                return null;
            }
            $data['country'] = $prefix;
            $data['mobile'] = $phone;
        }
        if ($email) {
            $user = $this->model->where('email', $email)->first();
            if ($user) {
                alert(__('message.user.add.title'), __('message.user.add.error'), 'error');
                return null;
            }
            $data['email'] = $email;
        }
        $data['status'] = 1;
        $data["username"] = Str::random(6);
        return $this->insert($data);
    }

    public function createToken(User $model): string
    {
        return $model->createToken('MehriNo Personal Access Token')->accessToken;
    }

    public function insert(array $data): User
    {
        return $this->model->create($data);
    }

    public function query()
    {
        return $this->model;
    }

    public function me()
    {
        return auth()->user();
    }

    public function meUpdate($request)
    {
        $newdata = new ReqUser();
        if ($request->has('email')) {
            $newdata->setEmail($request->email);
        }
        if ($request->has('mobile')) {
            $newdata->setMobile($request->mobile);
        }
        if ($request->has('username')) {
            $newdata->setUsername($request->username);
        }
        if ($request->has('name')) {
            $newdata->setName($request->name);
        }
        if ($request->has('latitude')) {
            $newdata->setLatitude($request->latitude);
        }
        if ($request->has('longitude')) {
            $newdata->setLongitude($request->longitude);
        }
        if ($request->hasFile('avatar')) {
            $newdata->setAvatar($request);
            imageOnQueue($newdata->avatar);
            deleteAll($this->me()->avatar);
        }
        if ($request->has('fee')) {
            $newdata->setFee($request->fee);
        }
        if ($request->has('private')) {
            $newdata->setPrivate($request->private);
        }
        return $this->me()->update($newdata->toArray());
    }

    public function findUUID($uuid)
    {
        return $this->model->whereUuid($uuid)->first();
    }

    public function updateProfile($request)
    {
        DB::beginTransaction();
        $user = auth('web')->user();
        $prev_file = $user->avatar;

        $result = $user->update([
            'name' => $request->name ?? $user->name,
            'username' => $request->username ?? $user->username,
            'email' => $request->email ?? $user->email,
            'mobile' => $request->mobile ?? $user->mobile,
            'new_password' => $request->new_password ? Hash::make($request->newnew_password) : $user->password,
            'avatar' => $request->hasFile('avatar') ? $request->file('avatar')->store(uploadPath('user/avatar/')) : $user->avatar,
        ]);

        if ($request->hasFile('avatar') && $prev_file !== null && Storage::disk('liara')->exists($prev_file)) {
            Storage::disk('liara')->delete($prev_file);
        }

        if (!$result) {
            DB::rollBack();
            alert(__('message.alert.error.title'), __('message.alert.error.message'), 'error');
            return back();
        }

        DB::commit();
        alert(__('message.alert.success.title'), __('message.alert.success.message', ['name' => 'پروفایل', 'type' => 'ویرایش']), 'success');
    }
}
