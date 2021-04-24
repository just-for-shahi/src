<?php


namespace App\Enums\BankAccount;


abstract class Status
{
    const REGISTERED = 0;
    const VERIFIED = 1;
    const LEGAL = 2;
    const BLOCKED = 3;

    const REGISTERED_HTML = "<span class=\"label label-lg font-weight-bold label-light-warning label-inline\">Waiting Approve</span>";
    const VERIFIED_HTML = "<span class=\"label label-lg font-weight-bold label-light-success label-inline\">Verified</span>";
    const LEGAL_HTML = "<span class=\"label label-lg font-weight-bold label-light-primary label-inline\">Legal Problem</span>";
    const BLOCKED_HTML = "<span class=\"label label-lg font-weight-bold label-light-danger label-inline\">Blocked</span>";
}
