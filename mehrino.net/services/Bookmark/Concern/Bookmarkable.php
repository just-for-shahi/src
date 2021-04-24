<?php


namespace Services\Bookmark\Concern;

use Illuminate\Database\Eloquent\Relations\morphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Services\Bookmark\Models\Bookmark;

trait Bookmarkable
{
    /**
     * Get all of the resource's bookmarks.
     */
    public function bookmarks(): morphMany
    {
        return $this->morphMany(Bookmark::class, 'bookmarkable');
    }

    /**
     * Get my like
     */
    public function isBookmark(): MorphOne
    {
        return $this->morphOne(Bookmark::class, 'bookmarkable')
            ->where('user', auth()->id());
    }

    /**
     * Create a like if it does not exist yet.
     */
    public function saveBookmark($userId)
    {
        return $this->bookmarks()->create([
            'user' => $userId
        ]);
    }

}
