<?php

namespace App\Concern;

trait Me{

    public function scopeMe(){
        return $this->where('user', auth('api')->id());
    }
}