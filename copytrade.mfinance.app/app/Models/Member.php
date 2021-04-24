<?php

namespace App\Models;

use App\Models\Account;
use App\Models\LicensingMemberBroker;
use App\Models\Product;
use App\Models\Tag;
use App\Models\UserBrokerServer;
use App\User;
use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Member extends Model
{
    use DefaultDatetimeFormat;

    protected $table = 'licensing_members';

    protected $fillable = ['user_id', 'expired_at',
         'max_live_accounts','max_demo_accounts','single_pc', 'lbl', 'license_key', 'auto_confirm_new_accounts', 'location'] ;

    public function manager()
    {
        return $this->hasOneThrough(User::class, User::class, 'id', 'id', 'user_id', 'manager_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function products()
    {
        return $this->belongsToMany(
            Product::class,
            'licensing_member_products', 'member_id', 'product_id');
    }

    public function brokers()
    {
        return $this->hasMany(LicensingMemberBroker::class);
    }

    public function accounts()
    {
        return $this->belongsToMany(Account::class, 'licensing_member_product_accounts',
            'member_id', 'account_id')->withPivot('confirmed');
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable', 'taggables');
    }

    public static function GenerateLicenseKey() {
        return Str::random(6);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($query) {
        });
    }

}
