<?php

namespace App\Enums;

use App\Enums\MT4_RunReturnType;

final class MT4_RunReturn
{
    private $returnType;
    private $message;

    public function __construct($returnType, $message = null)
    {
        $this->returnType = $returnType;
        $this->message = $message;
    }

    public function GetReturnType()
    {
        return $this->returnType;
    }

    public function GetMessage()
    {
        return $this->message;
    }
}
