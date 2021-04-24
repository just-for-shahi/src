<?php


namespace App\Enums\CallRequest;


class Status
{

    const REGISTERED = 0;
    const SPEAKED = 1;
    const NO_ANSWER = 2;
    const CANCELED = 3;


    const REGISTERED_HTML = "<span class=\"label label-lg font-weight-bold label-light-warning label-inline\">Registered</span>";
    const SPEAKED_HTML = "<span class=\"label label-lg font-weight-bold label-light-success label-inline\">Speaked</span>";
    const NO_ANSWER_HTML = "<span class=\"label label-lg font-weight-bold label-light-primary label-inline\">No Answer</span>";
    const CANCELED_HTML = "<span class=\"label label-lg font-weight-bold label-light-danger label-inline\">Canceled</span>";

}
