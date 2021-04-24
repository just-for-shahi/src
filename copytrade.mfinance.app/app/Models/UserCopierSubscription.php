<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\CopierSubscription;
use App\User;
use Encore\Admin\Traits\DefaultDatetimeFormat;

class UserCopierSubscription extends Model
{

    use DefaultDatetimeFormat;

    protected $table = 'copier_subscription_users';

    protected $fillable = ['user_id', 'copier_subscription_id', 'manager_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function subscription()
    {
        return $this->belongsTo(CopierSubscription::class, 'copier_subscription_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($query) {
            $user = User::find($query->user_id);
            $roleModel = config('admin.database.roles_model');
            $roleId = $roleModel::whereSlug('user_copier_subscriptions')->first()->id;

            $user->roles()->syncWithoutDetaching([$roleId]);
        });
    }
}
