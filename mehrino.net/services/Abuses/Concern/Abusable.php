<?php


namespace Services\Abuses\Concern;

use Illuminate\Database\Eloquent\Relations\morphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Services\Abuses\Models\Abuses;

trait Abusable
{

    /**
     * Get my like
     */
    public function isAbuses(): MorphOne
    {
        return $this->morphOne(Abuses::class, 'abusable')
            ->where('user', auth()->id());
    }

   /**
     * Get all of the resource's likes.
     */
    public function abuses(): morphMany
    {
        return $this->morphMany(Abuses::class, 'abusable');
    }


    /**
     * Create a like if it does not exist yet.
     */
    public function saveAbuses($userId,$type)
    {
        return $this->abuses()->create([
            'type' => $type,
            'user' => $userId
        ]);
    }
}
