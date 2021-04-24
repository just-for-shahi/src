<?php

namespace App\Models;

use App\Models\Strategy;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\StrategyOrder
 *
 * @property int $ticket
 * @property int $account_number
 * @property int $status
 * @property string|null $symbol
 * @property int|null $type
 * @property string|null $type_str
 * @property float|null $lots
 * @property float|null $price
 * @property float|null $stoploss
 * @property float|null $takeprofit
 * @property string|null $time_close
 * @property float|null $price_close
 * @property float|null $pl
 * @property string|null $time_open
 * @property string|null $time_last_action
 * @property int|null $magic
 * @property float $pips
 * @property float|null $swap
 * @property int $last_error_code
 * @property string|null $last_error
 * @property string $time_created
 * @property float|null $commission
 * @property string|null $comment
 * @property float|null $sl_pips
 * @property float|null $sl_dol
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property int|null $strategy_id
 * @property-read \App\Models\Strategy|null $strategy
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StrategyOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StrategyOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StrategyOrder query()
 * @mixin \Eloquent
 */
class StrategyOrder extends Model
{
    protected $table = 'strategy_orders';

    public function strategy()
    {
        return $this->belongsTo(Strategy::class);
    }
}
