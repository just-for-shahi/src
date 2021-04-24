<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

/**
 * App\Models\UserSubscriptionSetting
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $max_email_subscriptions
 * @property int|null $max_copier_subscriptions
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $max_accounts
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserSubscriptionSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserSubscriptionSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserSubscriptionSetting query()
 * @mixin \Eloquent
 */
class UserSubscriptionSetting extends Model
{
    protected $table = 'user_subscription_settings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'max_email_subscriptions', 'max_copier_subscriptions', 'max_accounts'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($query) {
        });

        static::creating(function ($query) {
        });
    }
}
