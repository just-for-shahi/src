<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\CopierSubscription;
use Encore\Admin\Traits\DefaultDatetimeFormat;

class CopierSubscriptionGroup extends Model
{

    use DefaultDatetimeFormat;

    protected $table = 'copier_subscription_groups';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'title', 'enabled' ];

    public function manager()
    {
        return $this->belongsTo(User::class);
    }

    public function subscriptions()
    {
        return $this->belongsToMany(
            CopierSubscription::class,
            'copier_subscription_group_pivot', 'copier_subscription_group_id', 'copier_subscription_id');
    }
}
