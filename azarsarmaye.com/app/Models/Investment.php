<?php


namespace App\Models;


use App\Concern\Latest;
use App\Concern\Me;
use App\Concern\PersianDate;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Investment
 *
 * @property string $id
 * @property string $uuid
 * @property int $user
 * @property int $account
 * @property int|null $transaction
 * @property int $amount
 * @property string|null $invested_at
 * @property string|null $withdraw_at
 * @property string|null $profited_at
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read string $j_created
 * @property-read string $j_updated
 * @method static \Illuminate\Database\Eloquent\Builder|Investment findUUID($uuid)
 * @method static \Illuminate\Database\Eloquent\Builder|Investment getLatest($page, $search)
 * @method static \Illuminate\Database\Eloquent\Builder|Investment latest()
 * @method static \Illuminate\Database\Eloquent\Builder|Investment me()
 * @method static \Illuminate\Database\Eloquent\Builder|Investment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Investment newQuery()
 * @method static \Illuminate\Database\Query\Builder|Investment onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Investment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Investment whereAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Investment whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Investment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Investment whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Investment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Investment whereInvestedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Investment whereProfitedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Investment whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Investment whereTransaction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Investment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Investment whereUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Investment whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Investment whereWithdrawAt($value)
 * @method static \Illuminate\Database\Query\Builder|Investment withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Investment withoutTrashed()
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|Investment uuid($uuid)
 * @property int $user_id
 * @method static \Illuminate\Database\Eloquent\Builder|Investment whereUserId($value)
 * @property-read \App\Models\Transaction|null $_transaction
 */
class Investment extends Model
{
    use UUID, Latest, PersianDate, Me, SoftDeletes;

    protected $fillable = ['user_id', 'account', 'transaction', 'amount', 'invested_at', 'withdraw_at', 'profited_at', 'status'];

    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function _transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
