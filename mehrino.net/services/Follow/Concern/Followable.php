<?php


namespace Services\Follow\Concern;

use Illuminate\Database\Eloquent\Relations\morphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Services\Follow\Models\Follow;

trait Followable
{
    /**
     * Get all of the resource'sfollows.
     */
    public function follows(): morphMany
    {
        return $this->morphMany(Follow::class, 'followable');
    }

    /**
     * Get my like
     */
    public function isFollow(): MorphOne
    {
        return $this->morphOne(Follow::class, 'followable')
            ->where('user', auth()->id());
    }

    /**
     * Create a like if it does not exist yet.
     */
    public function saveFollow($userId)
    {
        return $this->follows()->create([
            'user' => $userId
        ]);
    }

}
