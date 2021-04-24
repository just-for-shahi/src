<?php

namespace App\Models;

use App\Models\Account;
use App\Models\CopierSubscription;
use App\User;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Model;

class ManagerSetting extends Model
{

    use DefaultDatetimeFormat;
    protected $table = 'manager_settings';

    protected $fillable = [
        'user_id', 'max_copiers', 'max_senders', 'max_followers', 'can_edit_brokers'
    ];

    protected $appends = [
        'senderCount',
        'followerCount',
        'copierCount'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function users()
    {
        return $this->hasMany(User::class, 'manager_id', 'user_id');
    }

    public function copiers()
    {
        return $this->hasMany(CopierSubscription::class, 'manager_id', 'user_id');
    }

    public function accounts()
    {
        return $this->hasMany(Account::class, 'manager_id', 'user_id');
    }

    public function senders()
    {
        return $this->accounts()->where('copier_type', CopierType::MASTER);
    }

    public function followers()
    {
        return $this->accounts()->where('copier_type', CopierType::SLAVE);
    }

    public function getSenderCountAttribute()
    {
        return $this->senders()->count();
    }

    public function getFollowerCountAttribute()
    {
        return $this->followers()->count();
    }

    public function getCopierCountAttribute()
    {
        return $this->copiers()->count();
    }

    public function canHaveSenders() {

        if($this->max_senders == 0)
            return true;

        return $this->senderCount < $this->max_senders;
    }

    public function canHaveFollowers() {

        if($this->max_followers == 0)
            return true;

        return $this->followerCount < $this->max_followers;
    }

    public function canHaveAccounts() {
        return $this->canHaveFollowers() || $this->canHaveSenders();
    }

    public function canHaveCopiers() {

        if($this->max_copiers == 0)
            return true;

        return $this->copierCount < $this->max_copiers;
    }

    public static function getCurrent() {
        return ManagerSetting::whereUserId(Admin::user()->id)->first();
    }
}
