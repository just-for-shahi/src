<?php


namespace App\Http\Controllers\Withdraw;


use App\Concern\Latest;
use App\Concern\Me;
use App\Concern\UUID;
use App\Enums\Withdraw\Status;
use App\Http\Controllers\Investment\Investment;
use App\Http\Controllers\Wallet\Wallet;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Http\Controllers\Withdraw\Withdraw
 *
 * @property string $id
 * @property string $uuid
 * @property int $account
 * @property int|null $wallet
 * @property int $investment
 * @property int $amount
 * @property string|null $inquiry
 * @property string|null $receipt
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw getLatest(int $page, ?string $search)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw me()
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw newQuery()
 * @method static \Illuminate\Database\Query\Builder|Withdraw onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw query()
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereInquiry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereInvestment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereReceipt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereWallet($value)
 * @method static \Illuminate\Database\Query\Builder|Withdraw withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Withdraw withoutTrashed()
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw findByUUID($uuid)
 * @property int $account_id
 * @property int|null $wallet_id
 * @property int $investment_id
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw uuid($uuid)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereInvestmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereWalletId($value)
 * @property-read mixed $is_cancellable
 */
class Withdraw extends Model
{
    use UUID, Me, Latest, SoftDeletes;

    protected $fillable = ['account_id', 'wallet_id', 'bank_account', 'service_account',
        'investment_id', 'amount', 'inquiry', 'receipt', 'status'];

    public function investment()
    {
        return $this->belongsTo(Investment::class);
    }

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }

    public function getIsCancellableAttribute()
    {
        return user()->can('access-entity', $this) && $this->status === Status::REGISTERED;
    }

}
