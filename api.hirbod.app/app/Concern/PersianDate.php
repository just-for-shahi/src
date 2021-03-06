<?php

namespace App\Concern;

use App\Facades\Persian\Persian;
use Morilog\Jalali\Jalalian;

trait PersianDate{

    public function getJCreatedAttribute() : string
    {
        return Persian::datetime($this->created_at);
    }

    public function getJUpdatedAttribute() : string
    {
        return Persian::datetime($this->updated_at);
    }

}