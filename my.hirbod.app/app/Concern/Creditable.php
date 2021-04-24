<?php
namespace App\Concern;

 
use App\Models\Credit;
use Illuminate\Database\Eloquent\Relations\morphMany;

trait Creditable
{
    /**
     * The "booting" method of the trait.
     */
    protected static function bootCreditable() : void
    {
        static::deleting(function ($resource) {
            $resource->credits->each->delete();
        });
    }
    /**
     * Get all of the resource's credits.
     */
    public function credits() : morphMany
    {
        return $this->morphMany(Credit::class, 'creditable');
    }
    /**
     * Create a credit if it does not exist yet.
     */
        public function credit(array $content)
    {
        return $this->credits()->create($content);
    }
    /**
     * Delete credit for a resource.
     */
    public function  delete_credit()
    {
        return $this->credits()->each->delete();
    }
}