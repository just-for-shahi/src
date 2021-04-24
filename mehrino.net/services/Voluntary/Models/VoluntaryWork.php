<?php


namespace Services\Voluntary\Models;


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
use Services\Status\Concern\Statusable;
use Services\User\Concern\BelongsToUser;
use Services\Comment\Models\Comment;
use Services\Report\Concern\Reportable;
use Services\Institute\Models\Institute;
use Services\Like\Concern\Likable;
use Services\Visit\Concern\Visitable;

class VoluntaryWork extends Model
{
    use UUID, Me, Latest, Distance, PersianDate, SoftDeletes, Attachable, Reportable, Likable, Visitable, Bookmarkable, BelongsToUser, Statusable, Abusable;

    protected $table = 'voluntary_works';

    protected $hidden = ['id'];

    protected $fillable = ['user', 'institutes', 'title', 'activity', 'target_audience', 'period',
        'language', 'location', 'latitude', 'longitude', 'address', 'capacity', 'description',
        'from', 'till', 'status', 'cover'];

    public function voluntaryRequests()
    {
        return $this->hasMany(VoluntaryRequest::class, 'voluntary_work');
    }

    public function institute()
    {
        return $this->belongsTo(Institute::class, 'institutes')->select([
            "id",
            "uuid",
            "title",
            "logo"
        ]);
    }

    public function institutes()
    {
        return $this->belongsTo(Institute::class, 'institutes')->select([
            "id",
            "uuid",
            "title",
            "logo"
        ]);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
        // TODO check status
        //->where('status', 1);
    }

}
