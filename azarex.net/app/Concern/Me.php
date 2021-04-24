<?php

namespace App\Concern;

trait Me
{

    public function scopeMe($query)
    {
        return $query->where('user_id', auth()->id());
    }
}
