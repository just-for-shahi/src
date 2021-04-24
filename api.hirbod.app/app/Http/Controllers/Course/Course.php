<?php


namespace App\Http\Controllers\Course;


use App\Concern\Latest;
use App\Concern\Me;
use App\Concern\PersianDate;
use App\Concern\UUID;
use App\Http\Controllers\Finance\Transaction;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Price;
use App\Models\Tag;
use App\Models\Visit;
use App\Models\Wishlist;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use Me, Latest, PersianDate, SoftDeletes , UUID;

    protected $fillable = ['user', 'title', 'cover', 'description', 'introduction', 'students', 'duration','level','status'];

    public function prices(){
        return $this->morphMany(Price::class, 'pricable');
    }

    public function transactions(){
        return $this->morphMany(Transaction::class, 'transactional');
    }
    public function wishlists(){
        return $this->morphMany(Wishlist::class, 'wishlistable')->where('user','=',auth()->user()->id);
    }
    public function myTransactions(){
        return $this->morphMany(Transaction::class, 'transactional')->where([["status","=",1],["user","=",auth()->user()->id]]);
    }

    public function lectures(){
        return $this->hasMany(Lecture::class, 'course');
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function categories(){
        return $this->morphToMany(Category::class, 'categorizable');
    }

    public function likes(){
        return $this->morphMany(Like::class, 'likable');
    }

    public function visits(){
        return $this->morphMany(Visit::class, 'visitable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class , 'commentable');
    }
}