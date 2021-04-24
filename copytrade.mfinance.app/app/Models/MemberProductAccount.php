<?php

namespace App\Models;

use App\Models\Account;
use App\Models\Member;
use App\Models\Product;
use App\User;
use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Model;

class MemberProductAccount extends Model
{

    use DefaultDatetimeFormat;

    protected $table = 'licensing_member_product_accounts';

    public function user()
    {
        return $this->hasOneThrough(User::class, Member::class, 'id', 'id', 'member_id', 'user_id');
    }

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }

    public function stat()
    {
        return $this->hasOneThrough(AccountStat::class, Account::class, 'id', 'account_number', 'account_id', 'account_number');
    }

}
