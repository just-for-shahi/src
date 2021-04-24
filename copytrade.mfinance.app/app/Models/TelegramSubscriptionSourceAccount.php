<?php

namespace App\Models;

use App\Models\Account;
use Illuminate\Database\Eloquent\Model;

class TelegramSubscriptionSourceAccount extends Model
{
    protected $table = 'telegram_subscription_source_accounts';

    public function accounts()
    {
        return $this->belongsTo(Account::class);
    }
}
