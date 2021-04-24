<?php


namespace App\Enums\Ticket;


abstract class Priority
{
    const NORMAL = 0;
    const NON_SIGNIFICANT = 1;
    const IMPORTANT = 2;

    const NORMAL_HTML = "<span class=\"label label-lg font-weight-bold label-light-primary label-inline\">Normal</span>";
    const NON_SIGNIFICANT_HTML = "<span class=\"label label-lg font-weight-bold label-light-dark label-inline\">Non Significant</span>";
    const IMPORTANT_HTML = "<span class=\"label label-lg font-weight-bold label-light-danger label-inline\">Important</span>";

}
