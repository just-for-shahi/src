<?php


namespace App\Enums\Investment;


abstract class Status
{
    const WAITING_PAYMENT = 0;
    const ACTIVE = 1;
    const FINISHED = 2;
    const CANCELED = 3;
    const BLOCKED = 4;

    const WAITING_PAYMENT_HTML = "<span class=\"label label-lg font-weight-bold label-light-warning label-inline\">Waiting Payment</span>";
    const ACTIVE_HTML = "<span class=\"label label-lg font-weight-bold label-light-success label-inline\">Active</span>";
    const FINISHED_HTML = "<span class=\"label label-lg font-weight-bold label-light-primary label-inline\">Finished</span>";
    const CANCELED_HTML = "<span class=\"label label-lg font-weight-bold label-light-danger label-inline\">Canceled</span>";
    const BLOCKED_HTML = "<span class=\"label label-lg font-weight-bold label-light-dark label-inline\">Blocked</span>";

}
