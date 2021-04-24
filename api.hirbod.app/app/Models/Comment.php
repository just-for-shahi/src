<?php


namespace App\Models;


use App\Concern\PersianDate;
use App\Concern\UUID;
use App\Facades\Persian\Persian;
use App\Http\Controllers\Account\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use UUID , SoftDeletes , PersianDate;

    protected $fillable = ['user', 'comment', 'rate', 'status', 'parent_id' , 'commentable_type', 'commentable_id'];

    public function user()
    {
        return $this->belongsTo(User::class , 'user');
    }

    public function commentable()
    {
        return $this->morphTo();
    }

    public function likes()
    {
        return $this->morphMany(Like::class , 'likable');
    }

    public function replies()
    {
        return $this->hasMany(Comment::class , 'parent_id' , 'id')->take(5);
    }

    public function getJCreatedAttribute() : string
    {
        return Persian::format($this->created_at);
    }

    public function getJUpdatedAttribute() : string
    {
        return Persian::format($this->updated_at);
    }

}