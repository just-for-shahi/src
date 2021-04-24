<?php


namespace App\Enums\User;


abstract class UserRole
{
    const Default = 0;
    const Support = 1;
    const Accountants = 2;
    const Sales = 3;
    const Police = 4;
    const Admin = 5;
    const SuperAdmin = 6;
}