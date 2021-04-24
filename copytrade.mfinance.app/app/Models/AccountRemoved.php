<?php

namespace App\Models;

use App\User;
use App\Models\ApiServer;
use App\Models\AccountStat;
use App\Models\BrokerServer;
use App\Models\CopierSubscription;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AccountRemoved
 *
 * @property int $id
 * @property int $account_number
 * @property string $password
 * @property string $broker_server_name
 * @property int $manager_id
 * @property int $creator_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $trade_allowed
 * @property int|null $symbol_trade_allowed
 * @property string|null $last_error
 * @property int|null $is_live
 * @property int|null $copier_type
 * @property string|null $api_server_ip
 * @property-read \App\User $manager
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AccountRemoved newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AccountRemoved newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AccountRemoved query()
 * @mixin \Eloquent
 */
class AccountRemoved extends Model
{
    protected $table = 'accounts_removed';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'account_number',
        'password',
        'broker_server_name',
        'manager_id',
        'creator_id',
        'trade_allowed',
        'symbol_trade_allowed',
        'last_error',
        'is_live',
        'copier_type',
        'api_server_ip'
    ];

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

}
