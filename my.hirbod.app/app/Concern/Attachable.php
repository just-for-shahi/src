<?php
namespace App\Concern;

use App\Models\Attachment;
use Illuminate\Database\Eloquent\Relations\morphMany;

trait Attachable
{
    /**
     * The "booting" method of the trait.
     */
    protected static function bootAttachable() : void
    {
        static::deleting(function ($resource) {
            $resource->attachments->each->delete();
        });
    }
    /**
     * Get all of the resource's attachments.
     */
    public function attachments() : morphMany
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }
    /**
     * Create a attachment if it does not exist yet.
     */
    public function attachment(string $path, string $type)
    {
        return $this->attachments()->create([
            'path' => $path,
            'type' => $type,
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