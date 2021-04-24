<?php


namespace Services\Attachment\Concern;

use Illuminate\Database\Eloquent\Relations\morphMany;
use Services\Attachment\Models\Attachment;

trait Attachable
{
    /**
     * The "booting" method of the trait.
     */
    protected static function bootAttachable(): void
    {
        static::deleting(function ($resource) {
            $resource->attachments->each->delete();
        });
    }
    /**
     * Get all of the resource's attachments.
     */
    public function attachments(): morphMany
    {
        return $this->morphMany(Attachment::class, 'attachable')->where('deleted_at', null);
    }
    /**
     * Create a attachment if it does not exist yet.
     */
    public function attachment(string $path, string $type, $userId)
    {
        return $this->attachments()->create([
            'path' => $path,
            'user' => $userId
        ]);
    }
    /**
     * Delete attachment for a resource.
     */
    public function delete_attachment()
    {
        return $this->attachments()->each->delete();
    }
}
