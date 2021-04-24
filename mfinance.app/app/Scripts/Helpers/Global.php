<?php

use App\Scripts\Helpers\GoHelper;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

const DO_NOT_REPORT_ERROR = 'DO_NOT_REPORT_ERROR';

/**
 * Return a versioned asset link.
 * @param string $value
 * @return string
 */
function vasset($value = '')
{
    return asset("$value?v=" . config('mfinance.version'));
}

/**
 * Flash a message to the session
 * @param string $type
 * @param null $value
 */
function flash($type = 'CREATED', $value = null)
{
    \App\Scripts\Helpers\SessionHelper::flash($type, $value);
}

/**
 * @Description Get authenticated user
 * @param $guard
 * @return User|Authenticatable|null
 */
function user($guard = null)
{
    return Auth::guard($guard)->user();
}

function go($key, $value = null)
{
    return GoHelper::go($key, $value);
}

function authorizeAdminsOnly()
{
    abort_if(!user()->is_admin, 403, 'This section is only accessible for admins.');
}

function redirectTo($response = null)
{
    throw new \App\Exceptions\CustomRedirectException($response);
}
