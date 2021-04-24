<?php


namespace App\Models;


use App\Concern\Latest;
use App\Concern\Me;
use App\Concern\PersianDate;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{

    use UUID, Me, Latest, PersianDate, SoftDeletes;

    protected $fillable = ['user', 'institutes', 'title', 'cover', 'content', 'latitude', 'longitude',
        'target', 'current_balance', 'collaborators', 'type', 'status'];

    public function tags(){
        return $this->morphToMany(Tag::class, 'taggable', 'taggable');
    }
    public function wishlists(){
        return $this->morphMany(Wishlist::class, 'wishlistable')->where('user','=',auth()->id());
    }

    public function categories(){
        return $this->morphToMany(Category::class, 'categorizable', 'categorizable');
    }

}
