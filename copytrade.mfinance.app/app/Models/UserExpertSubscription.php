<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\User;
use App\Models\EmailSubscription;
use App\Models\EmailSubscriptionSourceAccount;

/**
 * App\Models\UserExpertSubscription
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $expert_subscription_id
 * @property string|null $expired_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User $manager
 * @property-read \App\Models\ExpertSubscription|null $subscription
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserExpertSubscription newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserExpertSubscription newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserExpertSubscription query()
 * @mixin \Eloquent
 */
class UserExpertSubscription extends Model
{
    protected $table = 'expert_subscription_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['manager_id'];

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function subscription()
    {
        return $this->belongsTo(ExpertSubscription::class, 'expert_subscription_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($query) {
            $user = User::find($query->user_id);
            $roleModel = config('admin.database.roles_model');
            $roleId = $roleModel::whereSlug('user_expert_subscriptions')->first()->id;

            $user->roles()->syncWithoutDetaching([$roleId]);
        });
    }
}
