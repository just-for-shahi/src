<?php


namespace App\Enums\User;


abstract class UserStatus
{
    const Registered = 0;
    const Verified = 1;
    const Restricted = 2;
    const Suspended = 3;

}