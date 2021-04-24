<?php

namespace App\Models;

use App\Concern\Latest;
use App\Concern\PersianDate;
use App\Concern\UUID;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, Latest, UUID, PersianDate, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['first_name', 'last_name', 'email', 'email_verified_at', 'password', 'google2fa', 'secret_question',
        'secret_answer', 'role', 'status', 'birthday', 'registered_ip', 'local_currency', 'invited_by', 'firebase_token',
        'telegram_token', 'daily_limit', 'type', 'gender', 'username', 'tax_id', 'mobile', 'phone'];

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
}
