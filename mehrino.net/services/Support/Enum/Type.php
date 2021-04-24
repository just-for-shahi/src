<?php


namespace Services\Support\Enum;


abstract class Type
{
    const Waiting = "waiting";
    const Solved = "solved";
    const Working = "working";
    const NoAnswer = "noAnswer";
    const UserClose = "userClose";
    const ManagerClose = "managerClose";
}
