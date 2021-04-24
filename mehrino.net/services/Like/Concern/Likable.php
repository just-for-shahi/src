<?php


namespace Services\Like\Concern;

use Illuminate\Database\Eloquent\Relations\morphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Services\Like\Enum\Action;
use Services\Like\Models\Like;

trait Likable
{


    /**
     * Get all of the resource's likes.
     */
    public function likes(): morphMany
    {
        return $this->morphMany(Like::class, 'likable')->where('action', Action::LIKE);
    }

    /**
     * Get all of the resource's likes.
     */
    public function dislikes(): morphMany
    {
        return $this->morphMany(Like::class, 'likable')->where('action', Action::DISLIKE);
    }

    /**
     * Get my like
     */
    public function isLike(): MorphOne
    {
        return $this->morphOne(Like::class, 'likable')
            ->where('action', Action::LIKE)
            ->where('user', auth()->id());
    }

    /**
     * Get  my dislike
     */
    public function isDislike(): MorphOne
    {
        return $this->morphOne(Like::class, 'likable')
            ->where('action', Action::DISLIKE)
            ->where('user', auth()->id());
    }

    /**
     * Create a like if it does not exist yet.
     */
    public function saveLike($userId)
    {
        return $this->likes()->create([
            'action' => Action::LIKE,
            'user' => $userId
        ]);
    }

    /**
     * Create a like if it does not exist yet.
     */
    public function saveDisLike($userId)
    {
        return $this->dislikes()->create([
            'action' => Action::DISLIKE,
            'user' => $userId
        ]);
    }
}
