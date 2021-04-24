<?php

namespace App\Models;

use App\Jobs\ProcessPendingAccount;
use App\Models\Account;
use App\Models\AccountStat;

use App\Models\CopierSubscription;
use App\User;
use DateTimeInterface;
use Encore\Admin\Auth\Database\Administrator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


/**
 * App\Models\CopierSubscriptionDestAccount
 *
 * @property int $id
 * @property int|null $copier_subscription_id
 * @property int|null $account_id
 * @property float|null $fixed_lot
 * @property float|null $lots_multiplier
 * @property float|null $max_lots_per_trade
 * @property float|null $max_risk
 * @property float|null $price_diff_accepted_pips
 * @property int|null $max_open_positions
 * @property int|null $risk_type
 * @property float|null $money_ratio_lots
 * @property float|null $money_ratio_dol
 * @property float|null $min_balance
 * @property int|null $live_time
 * @property int|null $enabled
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Account|null $account
 * @property-read \App\Models\BrokerServer|null $broker_server
 * @property-read \App\User $creator
 * @property-read \App\Models\CopierSubscription|null $subscription
 * @property-read \App\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CopierSubscriptionDestAccount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CopierSubscriptionDestAccount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CopierSubscriptionDestAccount query()
 * @mixin \Eloquent
 * @property int|null $scaling_factor
 */
class CopierSubscriptionDestAccount extends Model
{
    protected $table = 'copier_subscription_dest_accounts';

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format($this->getDateFormat());
    }

    public function setDefaults(CopierSubscription $subscription)
    {
        $this->copier_subscription_id = $subscription->id;

        $this->risk_type = $subscription->risk_type;
        $this->scaling_factor = $subscription->scaling_factor;
        $this->lots_multiplier = $subscription->lots_multiplier;
        $this->fixed_lot = $subscription->fixed_lot;
        $this->money_ratio_dol = $subscription->money_ratio_dol;
        $this->money_ratio_lots = $subscription->money_ratio_lots;


        $this->min_balance = $subscription->min_balance;
        $this->max_open_positions = $subscription->max_open_positions;
        $this->max_lots_per_trade = $subscription->max_lots_per_trade;
        $this->max_risk = $subscription->max_risk;
        $this->price_diff_accepted_pips = $subscription->price_diff_accepted_pips;

        $this->enabled = 1;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'creator_id', 'copier_subscription_id', 'account_id', 'manager_id',
        'risk_type', 'scaling_factor', 'fixed_lot', 'lots_multiplier', 'max_lots_per_trade', 'money_ratio_lots',
        'money_ratio_dol', 'price_diff_accepted_pips', 'min_balance', 'live_time', 'enabled'
    ];

    public function broker_server()
    {
        return $this->hasOneThrough(BrokerServer::class, Account::class,
            'id', 'id', 'account_id', 'broker_server_name');
    }

    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }

    public function subscription()
    {
        return $this->belongsTo(CopierSubscription::class, 'copier_subscription_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function user()
    {
        return $this->hasOneThrough(User::class, Account::class, 'id', 'id', 'account_id', 'user_id');
    }

    public function stat()
    {
        return $this->hasOneThrough(AccountStat::class, Account::class, 'id', 'account_number', 'account_id', 'account_number');
    }

    protected static function boot()
    {
        parent::boot();

        static::saved(function (CopierSubscriptionDestAccount $dest) {
            $account = $dest->account()->first();
            if ($account) {
                $account->account_status = AccountStatus::PENDING;
                $account->processing = true;
                $account->save();

                ProcessPendingAccount::dispatch($account->id)->onQueue($account->getConnectingQueueName());
            }
        });
    }

    public static function get_list($subscription_id)
    {
        return DB::table('copier_subscription_dest_accounts')
            ->join('accounts', 'accounts.account_number', '=',
                'copier_subscription_dest_accounts.account_number')
            ->join('broker_servers', 'accounts.broker_server_name', '=', 'broker_servers.name')
            ->select(
                'copier_subscription_dest_accounts.id',
                'accounts.name',
                'user_id',
                'accounts.account_number',
                'broker_servers.name as broker_name',
                'copier_type',
                'account_status',
                'copier_subscription_dest_accounts.enabled'
            )
            ->where('copier_subscription_id', '=', $subscription_id)
            ->get();
    }
}
