<?php


namespace App\Enums\Account;


abstract class Status
{
    const REGISTERED = 0;
    const VERIFIED = 1;
    const SUPERVISION = 2;
    const DISABLED = 3;
}
