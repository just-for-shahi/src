<?php

namespace App\Models;

use App\Models\Account;
use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Model;

class EmailSubscriptionSourceAccount extends Model
{

    use DefaultDatetimeFormat;

    protected $table = 'email_subscription_source_accounts';

    public function accounts()
    {
        return $this->belongsTo(Account::class);
    }
}
