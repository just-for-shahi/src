<?php


namespace App\Http\Controllers;


use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function show()
    {
        $team = User::where('captain', auth()->id())->get();

        return view('profile', ['user' => auth()->user(), 'team' => $team]);
    }

    public function update(UpdateProfileRequest $request)
    {
        try {
            $usr = auth()->user();
            $data = [
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
            ];
            if ($usr->identity_no === null) {
                $data['identity_no'] = $request->input('identity_no');
            }
            if ($usr->status === 0) {
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
            }
            if ($request->has('current_password') && $request->input('current_password') != null) {
                if (!$request->has('new_password') && $request->input('new_password') != null) {
                    return back()->with(['error' => 'رمز عبور جدید را وارد کنید']);
                }
                if (!Hash::check($request->input('current_password'), auth()->user()->password)) {
                    return back()->with(['error' => 'رمز عبور فعلی مطابقت ندارد']);
                }
                $data['password'] = Hash::make($request->input('new_password'));
            }
            User::where('id', auth()->id())->update($data);
            return redirect()->route('profile.show')->with(['success' => true]);
        } catch (\Exception $e) {
            return dd($e->getMessage());
            Bugsnag::notifyException($e);
            return back()->withInput()->withErrors();
        }
    }

}
