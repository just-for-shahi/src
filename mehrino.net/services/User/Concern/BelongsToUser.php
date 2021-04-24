<?php


namespace Services\User\Concern;


use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Services\User\Models\User;

trait BelongsToUser
{
    public function user()
    {
        return $this->belongsTo(User::class, 'user')->select([
            "id",
            "uuid",
            "name",
            "avatar"
        ]);
    }
    public function full_user()
    {
        return $this->belongsTo(User::class, 'user');
    }
}
