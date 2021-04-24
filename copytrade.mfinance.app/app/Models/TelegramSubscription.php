<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Account;
use App\User;
use App\Models\JfxMode;
use Encore\Admin\Traits\DefaultDatetimeFormat;

class TelegramSubscription extends Model
{

    use DefaultDatetimeFormat;
    protected $table = 'telegram_subscriptions';

    protected $fillable = ['manager_id', 'title'];

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function sources()
    {
        return $this->belongsToMany(Account::class, 'telegram_subscription_source_accounts');
    }

    public function refreshWebHooks()
    {
        foreach ($this->sources()->get() as $item) {
            $item->jfx_mode = $item->jfx_mode|JfxMode::WEBHOOK_ENABLED;
            //todo::reload settings on vps
            //$item->account_status = AccountStatus::PENDING;
            //$item->save();
        }
    }
}
