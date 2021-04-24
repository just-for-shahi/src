<?php


namespace App\Enums\Support;


abstract class ComplaintStatus
{
    const Waiting = 0;
    const Solved = 1;
    const Working = 2;
    const NoAnswer = 3;
}