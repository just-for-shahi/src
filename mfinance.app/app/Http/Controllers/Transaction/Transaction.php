<?php


namespace App\Http\Controllers\Transaction;


use App\Concern\Latest;
use App\Concern\Me;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Http\Controllers\Transaction\Transaction
 *
 * @property string $id
 * @property string $uuid
 * @property int $account
 * @property int $no
 * @property int $type
 * @property int $from
 * @property int $to
 * @property int $amount
 * @property string|null $description
 * @property string $authority
 * @property string|null $trace_number
 * @property string|null $reason
 * @property int $cryptocurrency
 * @property string|null $fee
 * @property string|null $hash
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction getLatest(int $page, ?string $search)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction me()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newQuery()
 * @method static \Illuminate\Database\Query\Builder|Transaction onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereAuthority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCryptocurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereHash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereTraceNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereUuid($value)
 * @method static \Illuminate\Database\Query\Builder|Transaction withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Transaction withoutTrashed()
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction findByUUID($uuid)
 * @property int $account_id
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction uuid($uuid)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereAccountId($value)
 */
class Transaction extends Model
{
    use UUID, Me, Latest, SoftDeletes;

    protected $fillable = ['account_id', 'no', 'type', 'from', 'to', 'amount', 'description', 'authority', 'trace_number',
        'reason', 'cryptocurrency', 'fee', 'hash', 'status'];


}
