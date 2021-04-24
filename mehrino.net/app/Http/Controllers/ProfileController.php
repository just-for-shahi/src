<?php


namespace App\Http\Controllers;


use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function show(){
        try{
            $team = User::where('captain', auth()->id())->get();
            return view('profile', ['user' => auth()->user(), 'team' => $team]);
        }catch (\Exception $e){
            Bugsnag::notifyException($e);
            return back()->withInput()->withErrors();
        }
    }

    public function update(UpdateProfileRequest $request){
        try{

            $data = [
                'name' => $request->input('name'),
                'username' => $request->input('username'),
            ];
            if ($request->has('current_password') && $request->input('current_password') != null){
                if (!$request->has('new_password') && $request->input('new_password') != null){
                    return back()->with(['error' => 'رمز عبور جدید را وارد کنید']);
                }
                if (!Hash::check($request->input('current_password'),auth()->user()->password)){
                    return back()->with(['error' => 'رمز عبور فعلی مطابقت ندارد']);
                }
                $data['password'] = Hash::make($request->input('new_password'));
            }
            User::where('id', auth()->id())->update($data);
            return redirect()->route('profile')->with(['success' => true]);
        }catch (\Exception $e){
            Bugsnag::notifyException($e);
            return back()->withInput()->withErrors();
        }
    }

}
