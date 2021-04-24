<?php

namespace App\Models;

use App\Models\Expert;

use App\User;
use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Model;

class ExpertSubscription extends Model
{

    use DefaultDatetimeFormat;

    protected $table = 'expert_subscriptions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['manager_id', 'name'];

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function experts()
    {
        return $this->belongsToMany(Expert::class, 'expert_subscription_experts');
    }

}
