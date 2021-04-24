<?php


namespace Services\Visit\Concern;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Services\Visit\Models\Visit;


trait Visitable
{
    /**
     * The "booting" method of the trait.
     */
    protected static function bootVisitable(): void
    {
        static::deleting(function ($resource) {
            $resource->visits->each->delete();
        });
    }

    /**
     * Get all of the resource's attachments.
     */
    public function visits(): MorphMany
    {
        return $this->morphMany(Visit::class, 'visitable');
    }

    /**
     * Get all of the resource's attachments.
     */

    public function visit(): MorphOne
    {
        return $this->morphOne(Visit::class, 'visitable')->where('user', auth()->id());
    }

    /**
     * Create a attachment if it does not exist yet.
     */
    public function saveVisit($data)
    {
        return $this->visits()->create($data);
    }

    /**
     * Delete attachment for a resource.
     */
    public function delete_visits()
    {
        return $this->visits()->each->delete();
    }
}
