<?php


namespace Services\User\Controllers;


use App\Enums\ResponseCode;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Illuminate\Http\Client\Request;
use Services\User\Repositories\IUserRepository;
use Services\User\Requests\UserRequests;

class PanelController
{
    private $user;

    public function __construct(IUserRepository $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        try {
            $items =  $this->user->db()->latest()->paginate(15);
            return view('views::user.index', compact('items'));
        } catch (\Exception $e) {
            return abort(ResponseCode::Error);
        }
    }

    public function create()
    {
        try {
            return view('views::user.create');
        } catch (\Exception $e) {
            Bugsnag::notifyException($e);
            return abort(ResponseCode::Error);
        }
    }

    public function store(UserRequests $r)
    {
        try {
            $user = $this->user->insertWithMobileOrEmail($r->input('email', null), $r->input('mobile', null), $r->only(['name', 'role']));
            if ($user) {
                if ($r->hasFile('file')) {
                    $path = $r->file('file')->store(uploadPath('profile'));
                    imageOnQueue($path);
                    $user->avatar = $path;
                    $user->save();
                }
                return redirect()->route('panel.users');
            }
            return back();
        } catch (\Exception $e) {
            Bugsnag::notifyException($e);
            return abort(ResponseCode::Error);
        }
    }

    public function profile($uuid){
        try {
            $user = $this->user->findUuid($uuid);
            if ($user === null) {
                return abort(404);
            }

            return view('views::user.profile', [
                'user' => $user
            ]);
        } catch (\Exception $e) {
            Bugsnag::notifyException($e);
            return abort(500);
        }
    }
    public function show($uuid)
    {
        try {
            $user = $this->user->findUuid($uuid);
            if ($user === null) {
                return abort(404);
            }

            return view('views::user.show', [
                'user' => $user
            ]);
        } catch (\Exception $e) {
            Bugsnag::notifyException($e);
            return abort(500);
        }
    }

    public function updated($uuid, UserRequests $r)
    {
        try {
            $user = $this->user->findUuid($uuid);
            if ($user === null) {
                return abort(404);
            }

            if ($r->hasFile('file')) {
                $path = $r->file('file')->store(uploadPath('profile'));
                imageOnQueue($path);
                $user->avatar = $path;
            }
            if ($r->has('email')) {
                $user->email = $r->email;
            }
            if ($r->has('mobile')) {
                [$prefix, $mobile] = $this->user->splitMobile($r->mobile);
                $user->mobile = $mobile;
                $user->country = $prefix;
            }
            if ($r->has('name')) {
                $user->name = $r->name;
            }
            $user->save();
            return redirect()->route('panel.users');
        } catch (\Exception $e) {
            Bugsnag::notifyException($e);
            return abort(500);
        }
    }

    public function destroy($uuid)
    {
        try {
            $this->model = $this->user->db()->where(['uuid' => $uuid, 'user' => auth()->id()])->first();
            if ($this->model === null) {
                return redirect()->back();
            }
            $this->model->delete();
            return redirect()->route('panel.users');
        } catch (\Exception $e) {
            Bugsnag::notifyException($e);
            return abort(500);
        }
    }
}
