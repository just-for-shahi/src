<?php
namespace App\Concern;

use App\Models\Visit;
use Illuminate\Database\Eloquent\Relations\morphMany;

trait Visitable
{
    /**
     * The "booting" method of the trait.
     */
    protected static function bootVisitable() : void
    {
        static::deleting(function ($resource) {
            $resource->all_visit->each->delete();
        });
    }
    /**
     * Get all of the resource's visits.
     */
    public function all_visit() : morphMany
    {
        return $this->morphMany(Visit::class, 'visitable');
    }

    /**
     * Get one of the resource's visits.
     */
    public function has_visit($user)
    {
        return $this->all_visit->where("user", $user)->first();
    }
    /**
     * Create a visit if it does not exist yet.
     */
    public function save_visit(int $user)
    {
        return $this->all_visit()->create([
            "user" => $user
        ]);
    }
    /**
     * Delete visit for a resource.
     */
    public function delete_visit()
    {
        return $this->all_visit()->each->delete();
    }
}