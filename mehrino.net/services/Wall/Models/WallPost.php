<?php


namespace Services\Wall\Models;


use App\Concern\Distance;
use App\Concern\Latest;
use App\Concern\Me;
use App\Concern\PersianDate;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Services\Abuses\Concern\Abusable;
use Services\Attachment\Concern\Attachable;
use Services\Bookmark\Concern\Bookmarkable;
use Services\Chat\Concern\Chatable;
use Services\Institute\Models\Institute;
use Services\Like\Concern\Likable;
use Services\Status\Concern\Statusable;
use Services\User\Concern\BelongsToUser;
use Services\Visit\Concern\Visitable;

class WallPost extends Model
{

    use UUID, Me, Latest, Distance, PersianDate, SoftDeletes, Attachable, Likable, Visitable, Chatable, Bookmarkable, BelongsToUser, Statusable, Abusable;

    protected $table = 'wall_posts';

    protected $fillable = ['wall', 'user', 'institutes', 'title', 'cover', 'content', 'type', 'status', 'latitude', 'longitude', 'private'];

    protected $hidden = ['id', 'attachments'];

    public function institute()
    {
        return $this->belongsTo(Institute::class, 'institutes')->select([
            "id",
            "uuid",
            "title",
            "logo"
        ]);
    }

    public function wall()
    {
        return $this->belongsTo(Wall::class, 'wall');
    }

}
