<?php

namespace App\Concern;

use App\Facades\Persian\Binance;

trait PersianDate{

    public function getJCreatedAttribute() : string
    {
        return Binance::datetime($this->created_at);
    }

    public function getJUpdatedAttribute() : string
    {
        return Binance::datetime($this->updated_at);
    }

}
