<?php

namespace App\Concern;

trait Latest{

    public function scopeGetLatest(int $count = 15, int $page = 1, ? string $search) : object
    {
        return $this->orderBy('created_at', 'desc')->search($search)->paginate($count, ["*"], $page);
    }
}
