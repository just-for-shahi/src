<?php


namespace App\Http\Controllers\Course;


use App\Concern\Me;
use App\Concern\PersianDate;
use App\Concern\UUID;
use App\Http\Controllers\Finance\Transaction;
use App\Models\Category;
use App\Models\Price;
use App\Models\Tag;
use App\Models\Wishlist;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use UUID, Me, PersianDate, SoftDeletes;

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

    public function categories(){
        return $this->morphToMany(Category::class, 'categorizable');
    }

    public function tags(){
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
