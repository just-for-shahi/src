<?php

namespace App\HModels;

use App\Concern\PersianDate;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use UUID, PersianDate, SoftDeletes, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'mobile','country', 'code', 'username', 'captain', 'team', 'balance', 'blue', 'role', 'plus', 'avatar', 'email',
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

}
