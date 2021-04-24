<?php


namespace App\Enums\Withdraw;


abstract class Status
{
    public const REGISTERED = 0;
    public const IN_PROGRESS = 1;
    public const PAYMENT = 2;
    public const DONE = 3;
    public const REJECTED = 4;
    public const BLOCKED = 5;
    public const CANCELLED_BY_USER = 6;

    public const REGISTERED_HTML = "<span class=\"label label-lg font-weight-bold label-light-primary label-inline\">Registered</span>";
    public const IN_PROGRESS_HTML = "<span class=\"label label-lg font-weight-bold label-light-warning label-inline\">In Progress</span>";
    public const PAYMENT_HTML = "<span class=\"label label-lg font-weight-bold label-light-success label-inline\">In Payment</span>";
    public const DONE_HTML = "<span class=\"label label-lg font-weight-bold label-light-success label-inline\">Done</span>";
    public const REJECTED_HTML = "<span class=\"label label-lg font-weight-bold label-light-danger label-inline\">Rejected</span>";
    public const BLOCKED_HTML = "<span class=\"label label-lg font-weight-bold label-light-danger label-inline\">Blocked</span>";
    public const CANCELLED_BY_USER_HTML = "<span class=\"label label-lg font-weight-bold label-light-warning label-inline\">Cancelled</span>";
}
