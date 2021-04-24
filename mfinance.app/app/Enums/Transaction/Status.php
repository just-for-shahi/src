<?php


namespace App\Enums\Transaction;


abstract class Status
{
    const WAITING_PAYMENT = 0;
    const PAID = 1;
    const IN_PROCESS = 2;
    const CANCELED = 3;
    const BLOCKED = 4;

    const WAITING_PAYMENT_HTML = "<span class=\"label label-lg font-weight-bold label-light-warning label-inline\">Waiting Payment</span>";
    const PAID_HTML = "<span class=\"label label-lg font-weight-bold label-light-success label-inline\">Paid</span>";
    const IN_PROCESS_HTML = "<span class=\"label label-lg font-weight-bold label-light-primary label-inline\">In Process</span>";
    const CANCELED_HTML = "<span class=\"label label-lg font-weight-bold label-light-danger label-inline\">Canceled</span>";
    const BLOCKED_HTML = "<span class=\"label label-lg font-weight-bold label-light-dark label-inline\">Blocked</span>";

}
