<?php

use Services\User\Enum\Role;

function makeUsername(string $username)
{
    return "https://uin.vet/u/$username";
}


function notify(string $let)
{
    \Bugsnag\BugsnagLaravel\Facades\Bugsnag::notifyException(new RuntimeException($let));
}


function notifyException(\Exception $ex)
{
    \Bugsnag\BugsnagLaravel\Facades\Bugsnag::notifyException($ex);
}

function slack(string $message)
{
    Illuminate\Support\Facades\Log::critical($message);
}

function mapper($class, $data, $fun)
{

    $array = get_object_vars($class);
    $res = [];
    foreach ($array as $key => $value) {
        try {
            $res[$key] = $data->{$key} ?? null;
        } catch (Exception $e) {
            $res[$key] = null;
        }
    }
    if ($fun)
        return $fun($res);
    else
        return $res;
}

function userMap($user)
{
    if (!$user) return null;
    return [
        'uuid' => $user->uuid,
        'name' => $user->name,
        'avatar' => getBaseUri($user->avatar),
    ];
}


function role($r)
{
    return  'admin' === $r ? 1 : 0;
}

function setGuardWeb(): void
{
    \Auth::shouldUse('web');
}

function setGuardApi(): void
{
    \Auth::shouldUse('api');
}
