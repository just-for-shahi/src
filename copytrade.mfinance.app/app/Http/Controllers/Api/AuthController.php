<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Exception;
use Hash;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Validator;
use Illuminate\Mail\Message;

class AuthController extends Controller
{
    public function ping(Request $request)
    {
        return response()->json(['success' => true]);
    }

    /**
     * API Register
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request)
    {
        $credentials = $request->only('username', 'name', 'email', 'password');
        $rules = [
            'username' => 'required|max:255|unique:users',
            'name' => 'required|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
        ];
        $validator = Validator::make($credentials, $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->messages()]);
        }
        $username = $request->username;
        $name = $request->username;
        $email = $request->email;
        $password = $request->password;
        User::create(['username' => $username, 'name' => $name, 'email' => $email, 'password' => Hash::make($password)]);

        return $this->login($request);
    }

    /**
     * API Login, on success return JWT Auth token
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
        $rules = [
            'username' => 'required',
            'password' => 'required',
        ];
        $validator = Validator::make($credentials, $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->messages()]);
        }
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['success' => false, 'message' => 'We cant find an account with this credentials.'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['success' => false, 'message' => 'Failed to login, please try again.'], 500);
        }
        return response()->json(['success' => true, 'token' => $token]);
    }

    /**
     * Log out
     * Invalidate the token, so user cannot use it anymore
     * They have to relogin to get a new token
     *
     * @param Request $request
     */
    public function logout(Request $request)
    {
        \Cookie::forget('token');
        auth()->logout();
        JWTAuth::invalidate(JWTAuth::parseToken());

        return response()->json(['success' => true, 'message' => "You have successfully logged out."]);
    }

    /**
     * API Recover Password
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function recover(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            $error_message = "Your email address was not found.";
            return response()->json(['success' => false, 'message' => ['email' => $error_message]], 500);
        }
        try {
            //$token = Password::createToken($user);
            Password::sendResetLink($request->only('email'));
        } catch (Exception $e) {
            //Return with error
            $error_message = $e->getMessage();
            return response()->json(['success' => false, 'message' => $error_message], 500);
        }
        return response()->json([
            'success' => true, 'message' => 'A reset email has been sent! Please check your email.'
        ]);
    }

    public function details(Request $request)
    {
        return response()->json(['success' => true, 'user' => $request->user()]);
    }
}
