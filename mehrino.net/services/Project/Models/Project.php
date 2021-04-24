<?php


namespace Services\Project\Models;


use App\Concern\Distance;
use App\Concern\Latest;
use App\Concern\Me;
use App\Concern\PersianDate;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Services\Abuses\Concern\Abusable;
use Services\Attachment\Concern\Attachable;
use Services\Category\Models\Category;
use Services\Institute\Models\Institute;
use Services\Bookmark\Concern\Bookmarkable;
use Services\Like\Concern\Likable;
use Services\Status\Concern\Statusable;
use Services\Tag\Models\Tag;
use Services\Transaction\Models\Transaction;
use Services\User\Concern\BelongsToUser;
use Services\Visit\Concern\Visitable;
use Services\Wishlist\Models\Wishlist;
use Services\Comment\Models\Comment;
use Services\Report\Concern\Reportable;

class Project extends Model
{

    use UUID,Distance, Me, Latest, PersianDate, SoftDeletes, Attachable, Likable, Bookmarkable, Visitable, Reportable, BelongsToUser , Statusable, Abusable;

    protected $fillable = ['user', 'institutes', 'title', 'cover', 'content', 'latitude', 'longitude',
        'target', 'current_balance', 'collaborators', 'type', 'status'];

    public function institute()
    {
        return $this->belongsTo(Institute::class, 'institutes')->select([
            "id",
            "uuid",
            "title",
            "logo"
        ]);
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable', 'taggable');
    }

    public function wishlists()
    {
        return $this->morphMany(Wishlist::class, 'wishlistable')->where('user', '=', auth()->id());
    }

    public function categories()
    {
        return $this->morphToMany(Category::class, 'categorizable', 'categorizable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
        // TODO check status
        //->where('status', 1);
    }

    public function transactions()
    {
        return $this->morphMany(Transaction::class, 'transactional');
    }

}
