<?php

namespace App\Concern;

trait Me{

    public function scopeMe(){
        return $this->where('account_id', auth()->id());
    }
}
