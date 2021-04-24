<?php

namespace App\Models;

use App\Models\Account;
use App\Models\CopierSubscription;
use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Model;

class CopierSubscriptionSourceAccount extends Model
{

    use DefaultDatetimeFormat;

    protected $table = 'copier_subscription_source_accounts';

    public function accounts()
    {
        return $this->belongsTo(Account::class);
    }

    public function subscription()
    {
        return $this->belongsTo(CopierSubscription::class);
    }
}
