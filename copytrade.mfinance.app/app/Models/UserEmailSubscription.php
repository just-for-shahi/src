<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\User;
use App\Models\EmailSubscription;
use Encore\Admin\Traits\DefaultDatetimeFormat;

class UserEmailSubscription extends Model
{

    use DefaultDatetimeFormat;

    protected $table = 'email_subscription_users';

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
        return $this->belongsTo(EmailSubscription::class, 'email_subscription_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($query) {
            $user = User::find($query->user_id);
            $roleModel = config('admin.database.roles_model');
            $roleId = $roleModel::whereSlug('user_email_subscriptions')->first()->id;

            $user->roles()->syncWithoutDetaching([$roleId]);
        });
    }
}
