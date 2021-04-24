<?php

namespace Services\User\Models;

use App\Concern\Distance;
use App\Concern\Latest;
use App\Concern\PersianDate;
use App\Concern\UUID;
use Fico7489\Laravel\EloquentJoin\Traits\EloquentJoin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Services\Follow\Concern\Followable;
use Services\Setting\Models\Setting;
use Services\Project\Models\Project;
use Services\Story\Models\Story;
use Services\Voluntary\Models\VoluntaryWork;
use Services\Wall\Models\WallPost;

/**
 * @OA\Schema(
 *     title="User",
 *     description="User model",
 * )
 */
class User extends Authenticatable
{
    use EloquentJoin, HasApiTokens, UUID, PersianDate, Latest, HasFactory, Notifiable ,Followable , Distance;

    /**
     * @OA\Property(
     *     title="ID",
     *     description="ID",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    protected $fillable = [
        'name', 'mobile', 'country', 'fee', 'code', 'username', 'captain', 'team', 'balance', 'blue', 'role',
        'plus', 'avatar', 'email', 'email_verified_at', 'password', 'status', 'last_connection', 'code_expire',
        'private', 'latitude', 'longitude'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setting()
    {
        return $this->belongsTo(Setting::class, 'id', 'user');
    }

    public function projects()
    {
        return $this->hasMany(Project::class, 'user');
    }
    public function voluntary()
    {
        return $this->hasMany(VoluntaryWork::class, 'user');
    }
    public function wall()
    {
        return $this->hasMany(WallPost::class, 'user');
    }

    public function stories()
    {
        return $this->hasMany(Story::class, 'user')->inDay();
    }
}
