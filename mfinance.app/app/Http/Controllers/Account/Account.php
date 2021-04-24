<?php


namespace App\Http\Controllers\Account;


use App\Concern\Me;
use App\Concern\UUID;
use App\Enums\Account\Role;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

/**
 * App\Http\Controllers\Account\Account
 *
 * @property string $id
 * @property string $uuid
 * @property string $first_name
 * @property string|null $last_name
 * @property int|null $country
 * @property string|null $mobile
 * @property string|null $email
 * @property string|null $password
 * @property int|null $otp
 * @property string|null $otp_expire
 * @property string|null $avatar
 * @property string|null $phone
 * @property string|null $address
 * @property string|null $zip
 * @property string|null $no
 * @property string|null $username
 * @property int|null $captain
 * @property int $ucoins
 * @property int $team
 * @property int $role
 * @property int $status
 * @property string|null $last_connection
 * @property int $balance
 * @property string|null $passport
 * @property string|null $client_id
 * @property string|null $client_secret
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|Account me()
 * @method static \Illuminate\Database\Eloquent\Builder|Account newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Account newQuery()
 * @method static \Illuminate\Database\Query\Builder|Account onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Account query()
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereCaptain($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereClientSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereLastConnection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereOtp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereOtpExpire($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account wherePassport($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereTeam($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereUcoins($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereZip($value)
 * @method static \Illuminate\Database\Query\Builder|Account withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Account withoutTrashed()
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|Account findByUUID($uuid)
 * @property int|null $captain_id
 * @method static \Illuminate\Database\Eloquent\Builder|Account uuid($uuid)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereCaptainId($value)
 * @property-read bool $is_admin
 */
class Account extends Authenticatable
{

    use UUID, Me, Notifiable, SoftDeletes;

    protected $fillable = ['first_name', 'last_name', 'country', 'mobile', 'email', 'password', 'otp', 'otp_expire', 'avatar', 'phone', 'address',
        'zip', 'no', 'username', 'captain_id', 'ucoins', 'team', 'role', 'status', 'last_connection', 'balance', 'passport',
        'client_id', 'client_secret'];

    public function getIsAdminAttribute()
    {
        return user()->role === Role::ADMIN;
    }
}
