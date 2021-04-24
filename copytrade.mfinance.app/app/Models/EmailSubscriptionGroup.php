<?php

namespace App\Models;

use App\User;
use App\Models\EmailSubscription;
use Illuminate\Database\Eloquent\Model;
use Encore\Admin\Traits\DefaultDatetimeFormat;

class EmailSubscriptionGroup extends Model
{

    use DefaultDatetimeFormat;

    protected $table = 'email_subscription_groups';

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
            EmailSubscription::class,
            'email_subscription_group_pivot', 'email_subscription_group_id', 'email_subscription_id');
    }
}
