<?php


namespace App\Models;


use App\Concern\Latest;
use App\Concern\Me;
use App\Concern\PersianDate;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Transaction
 *
 * @property string $id
 * @property string $uuid
 * @property int $user
 * @property int $from
 * @property int $to
 * @property int $amount
 * @property string|null $description
 * @property string $authority
 * @property string|null $trace_number
 * @property int $status
 * @property int $gateway
 * @property string|null $receipt
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read string $j_created
 * @property-read string $j_updated
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction findUUID($uuid)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction getLatest($page, $search)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction me()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newQuery()
 * @method static \Illuminate\Database\Query\Builder|Transaction onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereAuthority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereGateway($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereReceipt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereTraceNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereUuid($value)
 * @method static \Illuminate\Database\Query\Builder|Transaction withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Transaction withoutTrashed()
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction uuid($uuid)
 * @property int $user_id
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereUserId($value)
 */
class Transaction extends Model
{
    use UUID, Latest, PersianDate, Me, SoftDeletes;

    protected $fillable = ['user_id', 'from', 'to', 'amount', 'description', 'authority', 'trace_number', 'status', 'gateway'
        , 'receipt'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
