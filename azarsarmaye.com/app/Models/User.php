<?php

namespace App\Models;

use App\Concern\Latest;
use App\Concern\PersianDate;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

/**
 * App\Models\User
 *
 * @property string $id
 * @property string $uuid
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string $username
 * @property string|null $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string|null $mobile
 * @property string|null $code
 * @property int|null $captain
 * @property int $team
 * @property string|null $password
 * @property int $role
 * @property int $status
 * @property string|null $identity_no
 * @property string|null $identity_card_front
 * @property string|null $identity_card_back
 * @property string|null $code_expire
 * @property string|null $avatar
 * @property string|null $confession
 * @property string|null $residential
 * @property string|null $phone
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read int|null $clients_count
 * @property-read string $j_created
 * @property-read string $j_updated
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|User findUUID($uuid)
 * @method static \Illuminate\Database\Eloquent\Builder|User getLatest($page, $search)
 * @method static \Illuminate\Database\Eloquent\Builder|User latest()
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Query\Builder|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCaptain($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCodeExpire($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereConfession($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIdentityCardBack($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIdentityCardFront($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIdentityNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereResidential($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTeam($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUuid($value)
 * @method static \Illuminate\Database\Query\Builder|User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|User withoutTrashed()
 * @mixin \Eloquent
 * @property-read mixed $is_admin
 * @method static \Illuminate\Database\Eloquent\Builder|User uuid($uuid)
 * @property-read mixed $full_name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Wallet[] $wallets
 * @property-read int|null $wallets_count
 * @property-read mixed $summary
 */
class User extends Authenticatable
{
    use UUID, PersianDate, Latest, Notifiable, SoftDeletes, HasApiTokens;

    public const ADMIN = 6;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function getIsAdminAttribute()
    {
        return $this->role == self::ADMIN;
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getSummaryAttribute()
    {
        return implode(' - ', [
            $this->username,
            $this->full_name,
            $this->mobile
        ]);
    }
    public function wallets()
    {
        return $this->hasMany(Wallet::class)->confirmed();
    }

    /**
     * @param null|string $username
     * @return User
     */
    public static function getByUsername($username = null)
    {
        $user = self::whereUsername($username ?? \request('username'))->first();
        if (!$user) {
            flash('message', "کاربری به این نام وجود ندارد.");
            redirectTo();
        }

        return $user;
    }
}
