<?php


namespace Services\Chat\Concern;

use Illuminate\Database\Eloquent\Relations\MorphOne;
use Services\Chat\Models\Chat;

trait Chatable
{
    public function chat(): MorphOne
    {
        return $this->morphOne(Chat::class, 'chatable')->withDefault();
    }

    public function chatExsits($user_id)
    {
        return $this->chat()->where('user', $user_id)->first();
    }

    public function saveChat(array $data)
    {
        return $this->chat()->create($data);
    }
}
