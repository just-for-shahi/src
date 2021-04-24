<?php
namespace App\Concern;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Relations\morphMany;

trait Taggable
{
    /**
     * The "booting" method of the trait.
     */
    protected static function bootTagable() : void
    {
        static::deleting(function ($resource) {
            $resource->tags->each->delete();
        });
    }
    /**
     * Get all of the resource's tag.
     */
    public function tags() : morphMany
    {
        return $this->morphMany(Tag::class, 'tagable');
    }
    /**
     * Create a tag if it does not exist yet.
     */
    public function tag(array $data)
    {
        return $this->tags()->create($data);
    }
    /**
     * Delete tag for a resource.
     */
    public function  delete_tag()
    {
        return $this->tags()->each->delete();
    }
}
