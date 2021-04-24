<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Activation;
use App\Models\Profile;
use App\Traits\ActivationTrait;
use App\Traits\CaptureIpTrait;
use App\User;
use Auth;
use Carbon\Carbon;
use Encore\Admin\Auth\Database\Role;
use Encore\Admin\Facades\Admin;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class ActivateController extends Controller
{
    use ActivationTrait;

    private static $activationView = 'auth.activation';
    private static $activationRoute = 'activation-required';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Gets the activation view.
     *
     * @return string
     */
    public static function getActivationView()
    {
        return self::$activationView;
    }

    /**
     * Gets the activation route.
     *
     * @return string
     */
    public static function getActivationRoute()
    {
        return self::$activationRoute;
    }

    /**
     * Redirect the user after activation with admin logic.
     *
     * @param $user             The user
     * @param currentRoute      The current route
     *
     * @return Redirect
     */
    public static function activeRedirect($user, $currentRoute)
    {
        if ($user->activated) {
            Log::info('Activated user attempted to visit '.$currentRoute.'. ', [$user]);

            return redirect('/auth/login')
                ->with('status', 'info')
                ->with('message', trans('auth.alreadyActivated'));
        }

        return false;
    }

    /**
     * Initial Activation View.
     *
     * @return Redirect
     */
    public function initial()
    {
        $user = Auth()->user();

        $lastActivation = Activation::where('user_id', $user->id)->get()->last();
        $currentRoute = Route::currentRouteName();

        $rCheck = $this->activeRedirect($user, $currentRoute);
        if ($rCheck) {
            return $rCheck;
        }

        $data = [
            'email' => $user->email,
            'date'  => is_null($lastActivation) ? '' : $lastActivation->created_at->format('m/d/Y'),
        ];

        return view($this->getActivationView())->with($data);
    }

    /**
     * Check if actication is required.
     *
     * @return View
     */
    public function activationRequired()
    {
        $user = Auth()->user();
        $lastActivation = Activation::where('user_id', $user->id)->get()->last();
        $currentRoute = Route::currentRouteName();

        $rCheck = $this->activeRedirect($user, $currentRoute);
        if ($rCheck) {
            return $rCheck;
        }

        if ($user->activated == false) {
            $activationsCount = Activation::where('user_id', $user->id)
                ->where('created_at', '>=', Carbon::now()->subHours(config('admin.timePeriod')))
                ->count();

            if ($activationsCount > config('admin.maxAttempts')) {
                Log::info('Exceded max resends in last '.config('admin.timePeriod').' hours. '.$currentRoute.'. ', [$user]);

                $data = [
                    'email' => $user->email,
                    'hours' => config('admin.timePeriod'),
                ];

                return view('auth.exceeded')->with($data);
            }
        }

        Log::info('Registered attempted to navigate while unactivate. '.$currentRoute.'. ', [$user]);

        $data = [
            'email' => $user->email,
            'date'  => $lastActivation ? $lastActivation->created_at->format('m/d/Y') : null, //
        ];

        return view($this->getActivationView())->with($data);
    }

    /**
     * Activate a valid user with a token.
     *
     * @param string $token The token
     *
     * @return Redirect
     */
    public function activate($token)
    {
        /* @var $user App\User */
        $user = Auth()->user();

        $currentRoute = Route::currentRouteName();
        $ipAddress = new CaptureIpTrait();

        $profile = new Profile();

        $rCheck = $this->activeRedirect($user, $currentRoute);
        if ($rCheck) {
            return $rCheck;
        }

        $activation = Activation::where('token', $token)->get()
            ->where('user_id', $user->id)
            ->first();

        if (empty($activation)) {
            Log::info('Registered user attempted to activate with an invalid token: '.$currentRoute.'. ', [$user]);

            return redirect()->route(self::getActivationRoute())
                ->with('status', 'danger')
                ->with('message', trans('auth.invalidToken'));
        }

        $user->activated = true;

        $user->signup_confirmation_ip = $ipAddress->getClientIp();
        $user->profile()->Save($profile);
        $user->Save();

        Activation::where('user_id', $user->id)->delete();
        // foreach ($allActivations as $anActivation) {
        //     $anActivation->delete();
        // }

        Log::info('Registered user successfully activated. '.$currentRoute.'. ', [$user]);

        return redirect('/auth/login')
            ->with('status', 'success')
            ->with('message', trans('auth.successActivated'));
    }

    /**
     * Resend Activation.
     *
     * @return Redirect
     */
    public function resend()
    {
        $user = Auth::user();
        $lastActivation = Activation::where('user_id', $user->id)->get()->last();
        $currentRoute = Route::currentRouteName();

        if ($user->activated == false) {
            $activationsCount = Activation::where('user_id', $user->id)
                ->where('created_at', '>=', Carbon::now()->subHours(config('admin.timePeriod')))
                ->count();

            if ($activationsCount >= config('admin.maxAttempts')) {
                Log::info('Exceded max resends in last '.config('admin.timePeriod').' hours. '.$currentRoute.'. ', [$user]);

                $data = [
                    'email' => $user->email,
                    'hours' => config('admin.timePeriod'),
                ];

                return view('auth.exceeded')->with($data);
            }

            $sendEmail = $this->initiateEmailActivation($user);

            Log::info('Activation resent to registered user. '.$currentRoute.'. ', [$user]);

            return redirect()->route(self::getActivationRoute())
                ->with('status', 'success')
                ->with('message', trans('auth.activationSent'));
        }

        Log::info('Activated user attempte to navigate to '.$currentRoute.'. ', [$user]);

        return $this->activeRedirect($user, $currentRoute)
            ->with('status', 'info')
            ->with('message', trans('auth.alreadyActivated'));
    }

    /**
     * Check if use is already activated.
     *
     * @return Redirect
     */
    public function exceeded()
    {
        $user = Auth()->user();
        $currentRoute = Route::currentRouteName();
        $timePeriod = config('admin.timePeriod');
        $lastActivation = Activation::where('user_id', $user->id)->get()->last();
        $activationsCount = Activation::where('user_id', $user->id)
            ->where('created_at', '>=', Carbon::now()->subHours($timePeriod))
            ->count();

        if ($activationsCount >= config('admin.maxAttempts')) {
            Log::info('Locked non-activated user attempted to visit '.$currentRoute.'. ', [$user]);

            $data = [
                'hours'    => $timePeriod,
                'email'    => $user->email,
                'lastDate' => $lastActivation->created_at->format('m/d/Y'),
            ];

            return view('auth.exceeded')->with($data);
        }

        return $this->activeRedirect($user, $currentRoute)
            ->with('status', 'info')
            ->with('message', trans('auth.alreadyActivated'));
    }
}