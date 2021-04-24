<?php

namespace App\Enums;

final class ApiServerStatReturn
{
    private $val;
    private $date;

    public function __construct($date, $val)
    {
        $this->date = $date;
        $this->val = $val;
    }

    public function GetDate()
    {
        return $this->date;
    }

    public function GetVal()
    {
        return $this->val;
    }

}
