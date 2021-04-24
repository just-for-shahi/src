<?php

namespace Services\Wall\Models;

use App\Concern\Distance;
use App\Concern\Latest;
use App\Concern\Me;
use App\Concern\PersianDate;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Services\Attachment\Concern\Attachable;
use Services\Institute\Models\Institute;
use Services\User\Models\User;

/**
 * Wall
 * @author Sajadweb
 * Fri Dec 25 2020 02:44:18 GMT+0330 (Iran Standard Time)
 */
class Wall extends Model
{
    use UUID, Me, Distance, Latest, PersianDate, SoftDeletes, Attachable;
    protected $table = "wall";
    protected $fillable = ['user', 'institutes', 'title', 'cover', 'description', 'latitude', 'longitude',
        'type', 'private', 'status'];

    public function institutes()
    {
        return $this->belongsTo(Institute::class, 'institutes', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user', 'id');
    }

    public function wallPosts()
    {
        return $this->hasMany(WallPost::class , 'wall');
    }
}
