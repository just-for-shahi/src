<?php


namespace App\Enums\Course;


abstract class CourseStatus
{
    const Draft = 0;
    const Registered = 1;
    const Published = 2;
    const Restricted = 3;
    const Rejected = 4;
    const Legal = 5;
}