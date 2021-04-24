<?php

namespace App\Concern;

trait Latest{

    public function scopeGetLatest(?string $search, int $count = 15, int $page = 1) : object
    {
        return $this->orderBy('created_at', 'desc')->search($search)->paginate($count, ["*"], $page);
    }
}
