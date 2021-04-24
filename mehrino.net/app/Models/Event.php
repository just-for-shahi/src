<?php


namespace App\Models;

use App\Concern\Latest;
use App\Concern\Me;
use App\Concern\PersianDate;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{

    use UUID, Me, Latest, PersianDate, SoftDeletes;

    protected $fillable = ['user', 'from', 'till', 'location', 'title', 'introduction', 'cover', 'contributor',
        'address', 'latitude', 'longitude', 'price', 'specific_price', 'live', 'video', 'dedicated', 'private', 'type', 'status'];

    public function tags(){
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function categories(){
        return $this->morphToMany(Category::class, 'categorizable');
    }

    public function faqs(){
        return $this->morphToMany(FAQ::class, 'faqable');
    }

    public function organizers(){
        return $this->hasMany(EventOrganizer::class, 'event');
    }

    public function registrations(){
        return $this->hasMany(EventRegistration::class, 'event');
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
}
