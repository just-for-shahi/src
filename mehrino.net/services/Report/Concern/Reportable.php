<?php


namespace Services\Report\Concern;

use Illuminate\Database\Eloquent\Relations\morphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Services\Report\Models\Report;

trait Reportable
{
    /**
     * Get all of the resource's likes.
     */
    public function reports(): morphMany
    {
        return $this->morphMany(Report::class, 'reportable');
    }

    /**
     * Create a like if it does not exist yet.
     */
    public function saveReport($data)
    {
        return $this->reports()->create($data);
    }
}
