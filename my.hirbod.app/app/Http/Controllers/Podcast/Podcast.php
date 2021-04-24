<?php


namespace App\Http\Controllers\Podcast;


use App\Concern\Latest;
use App\Concern\Me;
use App\Concern\PersianDate;
use App\Concern\UUID;
use App\Http\Controllers\Finance\Transaction;
use App\Models\Category;
use App\Models\Price;
use App\Models\Tag;
use App\Models\Wishlist;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Podcast extends Model
{
    use UUID, Me, Latest, PersianDate, SoftDeletes;
    protected $fillable = ['user','title', 'logo', 'cover', 'description', 'website', 'status'];

    public function wishlists(){
        return $this->morphMany(Wishlist::class, 'wishlistable')->where('user','=',auth()->user()->id);
    }
    public function prices(){
        return $this->morphMany(Price::class, 'pricable');
    }
    public function episodes(){
        return $this->hasMany(Episode::class, 'podcast');
    }

    public function transactions(){
        return $this->morphMany(Transaction::class, 'transactional');
    }
    public function myTransactions(){
        return $this->morphMany(Transaction::class, 'transactional')->where([["status","=",1],["user","=",auth()->user()->id]]);
    }

    /**
     * Scope a query to search
     */
    public function scopeSearch(Builder $query, ? string $search)
    {
        if ($search) {
            return $query->where(function ($query) use ($search) {
                return $query->orWhere("name", "LIKE", "%{$search}%")
                    ->orWhere("description", "LIKE", "%{$search}%")
                    ->orWhere("website", "LIKE", "%{$search}%")
                    ->orWhere("status", $search);
            });
        }
        return $query;
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function categories(){
        return $this->morphToMany(Category::class, 'categorizable');
    }

}
