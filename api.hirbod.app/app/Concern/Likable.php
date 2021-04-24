<?php
namespace App\Concern;

use App\Models\Like;
use Illuminate\Database\Eloquent\Relations\morphMany;
use Carbon\Carbon;

trait Likable
{
    /**
     * The "booting" method of the trait.
     */
    protected static function bootLikable() : void
    {
        static::deleting(function ($resource) {
            $resource->all_like->each->delete();
        });
    }
    /**
     * Get all of the resource's likes.
     */
    public function all_like() : morphMany
    {
        return $this->morphMany(Like::class, 'likable');
    }

    /**
     * Get one of the resource's likes.
     */
    public function has_like($user)
    {
        return $this->all_like->where("user", $user)->first();
    }
    /**
     * Create a like if it does not exist yet.
     */
    public function save_like(int $user)
    {
        return $this->all_like()->create([
            "user" => $user,
        ]);
    }
    /**
     * Delete like for a resource.
     */
    public function delete_like()
    {
        return $this->all_like()->each->delete();
    }
}