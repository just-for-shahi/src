<?php
namespace App;

use Encore\Admin\Facades\Admin;
use App\Models\Account;
use App\Models\CopierSubscription;
use App\Models\EmailSubscription;
use App\Models\ExpertSubscription;
use App\Models\Profile;
use App\Models\Social;
use App\Models\UserCopierSubscription;
use App\Models\UserEmailSubscription;
use App\Models\UserExpertSubscription;
use App\Models\UserSubscriptionSetting;
use Encore\Admin\Auth\Database\Administrator;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Notifications\Notifiable;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Administrator implements JWTSubject, CanResetPasswordContract
{
    use Notifiable;
    use HasRelationships;
    use CanResetPassword;

    protected $connection = 'mysql';

    protected $casts = [
        'meta' => 'array',
        'trusted_hosts' => 'array'
   ];

    protected $fillable = [
        'name','username', 'email', 'password','creator_id', 'manager_id', 'avatar','api_token', 'signup_ip_address','activated'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getIsAdminAttribute()
    {
        return $this->isAdministrator();
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function copiersubscriptions()
    {
        return $this->belongsToMany(
            CopierSubscription::class,
            UserCopierSubscription::class,
            'user_id',
            'copier_subscription_id'
        );
    }

    public function emailsubscriptions()
    {
        return $this->belongsToMany(
            EmailSubscription::class,
            UserEmailSubscription::class,
            'user_id',
            'email_subscription_id'
        );
    }

    public function expertsubscriptions()
    {
        return $this->belongsToMany(
            ExpertSubscription::class,
            UserExpertSubscription::class,
            'user_id',
            'expert_subscription_id'
        );
    }

    public function experts()
    {
        return $this->hasManyDeepFromRelations($this->expertsubscriptions(),
            (new ExpertSubscription)->experts());
    }

    public function accounts()
    {
        return $this->hasMany(Account::class);
    }

    public function subscriptionsettings() {
        return $this->hasOne(UserSubscriptionSetting::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($query) {
        });

        static::created(function (User $user) {
            $roleModel = config('admin.database.roles_model');
            $roleId = $roleModel::whereSlug('user')->first()->id;

            $user->roles()->syncWithoutDetaching([$roleId]);

            UserSubscriptionSetting::firstOrNew(
                ['user_id' => $user->id],
                ['max_accounts' => config('copier.max_accounts_def')]
            );
        });
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function social()
    {
        return $this->hasMany(Social::class);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public static function GetManagerId() {
        if(Admin::user()->isRole('assistant')) {
            return Admin::user()->manager_id;
        }

        return Admin::user()->id;
    }

}
