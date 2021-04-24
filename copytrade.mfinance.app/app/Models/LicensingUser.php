<?php

namespace App\Models;

use App\User;
use App\Models\Campaign;
use App\Models\Accounts;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\LicensingUser
 *
 * @property int $id
 * @property int|null $manager_id
 * @property string $username
 * @property string $password
 * @property string $name
 * @property string|null $avatar
 * @property string|null $remember_token
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int|null $creator_id
 * @property string|null $email
 * @property string|null $api_token
 * @property mixed|null $meta
 * @property string|null $theme
 * @property mixed|null $trusted_hosts
 * @property int|null $activated
 * @property string|null $signup_ip
 * @property string|null $signup_confirmation_ip
 * @property string|null $signup_sm_ip
 * @property string|null $last_login_at
 * @property string|null $last_login_ip
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Account[] $accounts
 * @property-read int|null $accounts_count
 * @property-read \App\Models\Campaign|null $campaign
 * @property-read \App\Models\Licensing|null $licensing
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LicensingUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LicensingUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LicensingUser query()
 * @mixin \Eloquent
 * @property string|null $note
 */
class LicensingUser extends Model
{
    protected $table = 'admin_users';
    public $timestamps = false;

    public function licensing()
    {
        return $this->hasOne(Licensing::class,'user_id');
    }

    public function accounts()
    {
        return $this->hasMany(Account::class, 'user_id');
    }

    public function campaign()
    {
        return $this->hasOneThrough(Campaign::class, Licensing::class,
            'user_id', 'id', 'user_id', 'campaign_id');
    }
}
