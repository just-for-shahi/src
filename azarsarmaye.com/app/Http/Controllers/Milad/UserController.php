<?php


namespace App\Http\Controllers\Milad;


use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    private $entity;

    public function __construct()
    {
        $this->entity = new User();
    }

    public function index()
    {
        return view('user.list', ['users' => User::latest()->paginate(15)]);
    }

    public function show(User $user)
    {
        $team = User::where('captain', auth()->id())->get();
        return view('admin.profile', compact('user', 'team'));
    }

    public function update(UpdateProfileRequest $request, User $user)
    {
        $data = [
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
        ];
        if ($user->identity_no === null) {
            $data['identity_no'] = $request->input('identity_no');
        }
        if ($request->hasFile('identity_card_front')) {
            $data['identity_card_front'] = $request->file('identity_card_front')->store('identity-cards');
        }
        if ($request->hasFile('identity_card_back')) {
            $data['identity_card_back'] = $request->file('identity_card_back')->store('identity-cards');
        }
        if ($request->hasFile('confession')) {
            $data['confession'] = $request->file('confession')->store('confessions');
        }
        if ($request->hasFile('residential')) {
            $data['residential'] = $request->file('residential')->store('residential');
        }
        $data['phone'] = $request->input('phone');
        $user->update($data);

        if ($request->has('current_password') && $request->input('current_password') != null) {
            if (!$request->has('new_password') && $request->input('new_password') != null) {
                return back()->with(['message' => 'رمز عبور جدید را وارد کنید']);
            }
            if (!Hash::check($request->input('current_password'), $user->password)) {
                return back()->with(['message' => 'رمز عبور فعلی مطابقت ندارد']);
            }
            $data['password'] = Hash::make($request->input('new_password'));
            $user->update($data);
        }


        flash('success');
        return back();
    }

}
