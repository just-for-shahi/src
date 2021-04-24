<?php


namespace App\Http\Controllers\Event;


use App\Concern\PersianDate;
use App\Concern\UUID;
use App\Http\Controllers\Account\User;
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

class Event extends Model
{
    use PersianDate , UUID , SoftDeletes;

    protected $fillable = ['code', 'user', 'from', 'till', 'location', 'title', 'introduction', 'cover', 'contributor',
        'address', 'latitude', 'longitude', 'live', 'video', 'dedicated', 'status'];

    public function scopeLatest($query){
        return $query->orderBy('created_at', 'desc');
    }

    public function tags(){
        return $this->morphToMany(Tag::class, 'taggable');
    }
    public function scopeMe(){
        return $this->where('user', auth()->id());
    }


    public function categories(){
        return $this->morphToMany(Category::class, 'categorizable');
    }

    public function prices(){
        return $this->morphMany(Price::class, 'pricable');
    }

    public function faqs(){
        return $this->hasMany(EventFaq::class, 'event');
    }

    public function organizers(){
        return $this->hasMany(EventOrganizer::class, 'event');
    }

    public function registrations(){
        return $this->hasMany(EventOrganizer::class, 'event');
    }

    public function scheduling(){
        return $this->hasMany(EventScheduling::class, 'event');
    }

    public function speakers(){
        return $this->hasMany(EventSpeaker::class, 'event');
    }
    public function wishlists(){
        return $this->morphMany(Wishlist::class, 'wishlistable')->where('user','=',auth()->user()->id);
    }

    public function sponsors(){
        return $this->hasMany(EventSponsor::class, 'event');
    }
    public function transactions(){
        return $this->morphMany(Transaction::class, 'transactional');
    }
    public function myTransactions(){
        return $this->morphMany(Transaction::class, 'transactional')->where([["status","=",1],["user","=",auth('api')->user()->id]]);
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

    public function user()
    {
        return $this->belongsTo(User::class , 'user');
    }

}