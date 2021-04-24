<?php


namespace App\Enums\SMS;


abstract class Type
{
    const AUTH = 0;
    const FINANCE = 1;
    const GENERAL = 2;
    const NOTIFICATION = 3;
    const CAMPAIGN = 4;
    const TEMPLATE = 5;
}