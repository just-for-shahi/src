<?php


namespace App\Http\Controllers\EBook;


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
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EBook extends Model
{
    use UUID, Me, Latest, PersianDate, SoftDeletes;
    protected $table = 'ebooks';
    protected $fillable = ['user', 'title','year', 'cover', 'description', 'introduction', 'readers', 'pages', 'sample', 'file', 'isbn',
        'level', 'status', 'token', 'sample_token'];

    public function prices(){
        return $this->morphMany(Price::class, 'pricable');
    }
    public function transactions(){
        return $this->morphMany(Transaction::class, 'transactional');
    }
    public function myTransactions($usr){
        return $this->morphMany(Transaction::class, 'transactional')->where(["status" => 1, "user" => $usr]);
    }

    /**
     * Scope a query to search
     */
    public function scopeSearch(Builder $query, ? string $search)
    {
        if ($search) {
            return $query->where(function ($query) use ($search) {
                return $query->orWhere("code", "LIKE", "%{$search}%")
                    ->orWhere("title", "LIKE", "%{$search}%")
                    ->orWhere("description", "LIKE", "%{$search}%")
                    ->orWhere("level", "LIKE", "%{$search}%")
                    ->orWhere("status", $search);
            });
        }
        return $query;
    }

    public function tags(){
        return $this->morphToMany(Tag::class, 'taggable');
    }
    public function wishlists(){
        return $this->morphMany(Wishlist::class, 'wishlistable')->where('user','=',auth()->id());
    }

    public function categories(){
        return $this->morphToMany(Category::class, 'categorizable');
    }

    public function publishers(){
        return $this->morphToMany(Publisher::class, 'publisherable');
    }

    public function writers(){
        return $this->morphToMany(Writer::class, 'writerable');
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