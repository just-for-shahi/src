<?php


namespace Services\Support\Enum;


abstract class Status
{
    const Waiting = 0;
    const Solved = 1;
    const Working = 2;
    const NoAnswer = 3;
    const UserClose = 4;
    const ManagerClose = 5;
}
