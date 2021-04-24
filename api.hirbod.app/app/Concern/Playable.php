<?php
namespace App\Concern;

use App\Models\Play;
use Illuminate\Database\Eloquent\Relations\morphMany;

trait Playable
{
    /**
     * The "booting" method of the trait.
     */
    protected static function bootLikable() : void
    {
        static::deleting(function ($resource) {
            $resource->all_play->each->delete();
        });
    }
    /**
     * Get all of the resource's likes.
     */
    public function all_play() : morphMany
    {
        return $this->morphMany(Play::class, 'playable');
    }

    /**
     * Get one of the resource's likes.
     */
    public function has_play($user)
    {
        return $this->all_play->where("user", $user)->first();
    }
    /**
     * Create a like if it does not exist yet.
     */
    public function save_like(int $user)
    {
        return $this->all_play()->create([
            "user" => $user,
        ]);
    }
    /**
     * Delete like for a resource.
     */
    public function delete_play()
    {
        return $this->all_play()->each->delete();
    }
}