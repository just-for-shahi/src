<?php


namespace Services\Status\Concern;

use Illuminate\Database\Eloquent\Relations\morphMany;
use Services\Status\Models\Status;

trait Statusable
{
    /**
     * Get all of the resource's status.
     */
    public function status(): morphMany
    {
        return $this->morphMany(Status::class, 'statusable');
    }

    /**
     * Create a like if it does not exist yet.
     */
    public function saveStatus($userId , $status = 0)
    {
        return $this->status()->create([
            'user' => $userId,
            'status' => $status
        ]);
    }
}