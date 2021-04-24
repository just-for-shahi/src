<?php


namespace App\Http\Controllers\Story;


use App\Concern\InDay;
use App\Concern\Me;
use App\Concern\PersianDate;
use App\Concern\UUID;
use App\Http\Controllers\Account\User;
use App\Models\Attachment;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Visit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Story extends Model
{
    use Me, SoftDeletes , UUID , PersianDate , InDay;
    protected $fillable = ['user','intent_type','intent_id', 'file'];

    public function photos(){
        return $this->morphToMany(Attachment::class, 'attachable');
    }

    public function user()
    {
        return $this->belongsTo(User::class , 'user');
    }

    public function likes()
    {
        return $this->morphMany(Like::class , 'likable');
    }

    public function visits()
    {
        return $this->morphMany(Visit::class , 'visitable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class , 'commentable');
    }

}