<?php


namespace Services\User\Enum;


abstract class VerifiedType
{
    const SUCCESS = 1;
    const  PENDING = 0;
    const  FAILURE = -1;
}
