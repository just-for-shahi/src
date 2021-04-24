<?php
namespace App\Concern;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Relations\morphMany;

trait Commentable
{
    /**
     * The "booting" method of the trait.
     */
    protected static function bootCommentable() : void
    {
        static::deleting(function ($resource) {
            $resource->comments->each->delete();
        });
    }
    /**
     * Get all of the resource's comments.
     */
    public function comments() : morphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
    /**
     * Create a comment if it does not exist yet.
     */
    public function comment(array $data)
    {
        return $this->comments()->create($data);
    }
    /**
     * Delete comment for a resource.
     */
    public function  delete_comment()
    {
        return $this->comments()->each->delete();
    }
}