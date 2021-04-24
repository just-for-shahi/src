<?php

namespace App\Http\Controllers\Account;

use App\Concern\InDay;
use App\Concern\PersianDate;
use App\Concern\UUID;
use App\Http\Controllers\Story\Story;
use App\Models\Comment;
use Fico7489\Laravel\EloquentJoin\Traits\EloquentJoin;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use UUID, PersianDate, SoftDeletes, Notifiable, HasApiTokens , InDay , EloquentJoin;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid', 'name', 'mobile','country', 'code', 'username', 'captain', 'team', 'balance', 'blue', 'role', 'plus', 'avatar', 'email',
        'email_verified_at', 'password', 'status','code_expire','last_connection', 'remember_token','provider','provider_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function stories()
    {
        return $this->hasMany(Story::class , 'user')->inDay();
    }

}
