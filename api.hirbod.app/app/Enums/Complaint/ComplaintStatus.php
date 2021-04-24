<?php


namespace App\Enums\Course;


abstract class ComplaintStatus
{
    const Queue = 0;
    const Solved = 1;
    const FollowUp = 2;
    const Referred = 3;
    const Closed = 4;
}