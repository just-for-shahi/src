<?php


namespace App\Enums\Wallet;


abstract class Status
{
    const REGISTERED = 0;
    const ACTIVE = 1;
    const REJECTED = 2;
    const BLOCKED = 3;
    const ARCHIVED = 4;

    const REGISTERED_HTML = "<span class=\"label label-lg font-weight-bold label-light-warning label-inline\">Waiting Approve</span>";
    const ACTIVE_HTML = "<span class=\"label label-lg font-weight-bold label-light-success label-inline\">Active</span>";
    const REJECTED_HTML = "<span class=\"label label-lg font-weight-bold label-light-danger label-inline\">Rejected</span>";
    const BLOCKED_HTML = "<span class=\"label label-lg font-weight-bold label-light-danger label-inline\">Blocked</span>";
    const ARCHIVED_HTML = "<span class=\"label label-lg font-weight-bold label-light-dark label-inline\">Archived</span>";
}
