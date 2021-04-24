<?php


namespace App\Enums\Ticket;


abstract class Status
{
    const WAITING = 0;
    const IN_PROGRESS = 1;
    const REPLIED = 2;
    const SOLVED = 3;

    const WAITING_HTML = "<span class=\"label label-lg font-weight-bold label-light-warning label-inline\">Waiting</span>";
    const IN_PROGRESS_HTML = "<span class=\"label label-lg font-weight-bold label-light-primary label-inline\">InProgress</span>";
    const REPLIED_HTML = "<span class=\"label label-lg font-weight-bold label-light-primary label-inline\">Replied</span>";
    const SOLVED_HTML = "<span class=\"label label-lg font-weight-bold label-light-success label-inline\">Solved</span>";
}
