<?php


namespace App\Enums\UAccount;


abstract class Status
{
    const IN_PROGRESS = 0;
    const ACTIVE = 1;
    const DEACTIVE = 2;
    const SUSPENDED = 3;

    const IN_PROGRESS_HTML = "<span class=\"label label-lg font-weight-bold label-light-warning label-inline\">In Progress</span>";
    const ACTIVE_HTML = "<span class=\"label label-lg font-weight-bold label-light-success label-inline\">Active</span>";
    const DEACTIVE_HTML = "<span class=\"label label-lg font-weight-bold label-light-danger label-inline\">DeActive</span>";
    const SUSPENDED_HTML = "<span class=\"label label-lg font-weight-bold label-light-danger label-inline\">Suspended</span>";
}
