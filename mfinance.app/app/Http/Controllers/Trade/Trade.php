<?php


namespace App\Http\Controllers\Trade;


use App\Concern\Latest;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Http\Controllers\Trade\Trade
 *
 * @property string $id
 * @property string $uuid
 * @property int $maccount_id
 * @property int $broker
 * @property string $order
 * @property string|null $open
 * @property int $type
 * @property float $size
 * @property string $symbol
 * @property string $open_price
 * @property string $sl
 * @property string $tp
 * @property string|null $close
 * @property string $close_price
 * @property string $swap
 * @property string $commission
 * @property string $result
 * @property string|null $comment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Trade getLatest(int $page, ?string $search)
 * @method static \Illuminate\Database\Eloquent\Builder|Trade newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Trade newQuery()
 * @method static \Illuminate\Database\Query\Builder|Trade onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Trade query()
 * @method static \Illuminate\Database\Eloquent\Builder|Trade whereMAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trade whereBroker($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trade whereClose($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trade whereClosePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trade whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trade whereCommission($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trade whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trade whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trade whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trade whereOpen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trade whereOpenPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trade whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trade whereResult($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trade whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trade whereSl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trade whereSwap($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trade whereSymbol($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trade whereTp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trade whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trade whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trade whereUuid($value)
 * @method static \Illuminate\Database\Query\Builder|Trade withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Trade withoutTrashed()
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|Trade findByUUID($uuid)
 * @property int $maccount_id
 * @method static \Illuminate\Database\Eloquent\Builder|Trade uuid($uuid)
 * @method static \Illuminate\Database\Eloquent\Builder|Trade whereMaccountId($value)
 */
class Trade extends Model
{
    use UUID, Latest, SoftDeletes;
    protected $fillable = ['maccount_id', 'broker', 'order', 'open', 'type', 'size', 'symbol', 'open_price', 'sl', 'tp',
        'close', 'close_price', 'swap', 'commission', 'result', 'comment'];

}
