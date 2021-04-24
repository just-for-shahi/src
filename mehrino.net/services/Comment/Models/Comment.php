<?php

namespace Services\Comment\Models;

use App\Concern\Latest;
use App\Concern\UUID;
use App\Concern\Me;
use App\Models\Like;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Services\Like\Concern\Likable;
use Services\User\Models\User;

/**
 * Comment
 * @author Sajadweb
 * Sun Dec 27 2020 13:51:25 GMT+0330 (Iran Standard Time)
 */
class Comment extends Model
{
    use UUID, Me, SoftDeletes, Latest, Likable;

    protected $guarded = ['id'];

    protected $fillable = ['user', 'comment' , 'status'];

    protected $hidden = ['status', 'commentable_type', 'commentable_id', 'updated_at', 'deleted_at'];

    public function commentable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user')->select(['id', 'uuid', 'name', 'avatar'])->withDefault();
    }

    public function replays()
    {
        return $this->morphMany(Comment::class, 'commentable');
        // TODO change status in prod
        //->where('status', 1);
    }
}
