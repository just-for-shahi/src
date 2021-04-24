<?php


namespace App\Enums;


abstract class ResponseCode
{
    const Success = 200;
    const Created = 201;
    const Bad = 400;
    const Unauthorized = 401;
    const Forbidden = 403;
    const NotFound = 404;
    const Error = 500;
}
