<?php


namespace App\Enums\Branch;


abstract class Status
{
    const REQUESTED = 0;
    const ACTIVE = 1;
    const HOLD = 2;
    const CLOSED = 3;
}
