<?php


namespace App\Http\Controllers\Investment;


use App\Concern\Latest;
use App\Concern\Me;
use App\Concern\UUID;
use App\Enums\Withdraw\Status;
use App\Helpers\Wallet\Currency;
use App\Http\Controllers\Withdraw\Withdraw;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Http\Controllers\Investment\Investment
 *
 * @property string $id
 * @property string $uuid
 * @property int $account
 * @property int|null $agent
 * @property int $branch
 * @property int $cryptocurrency
 * @property int $initial_deposit
 * @property int $amount
 * @property int $target
 * @property int $matching
 * @property string|null $invested_at
 * @property string|null $withdraw_at
 * @property string|null $last_change
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Investment getLatest(int $page, ?string $search)
 * @method static \Illuminate\Database\Eloquent\Builder|Investment me()
 * @method static \Illuminate\Database\Eloquent\Builder|Investment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Investment newQuery()
 * @method static \Illuminate\Database\Query\Builder|Investment onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Investment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Investment whereAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Investment whereAgent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Investment whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Investment whereBranch($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Investment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Investment whereCryptocurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Investment whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Investment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Investment whereInitialDeposit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Investment whereInvestedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Investment whereLastChange($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Investment whereMatching($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Investment whereTarget($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Investment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Investment whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Investment whereWithdrawAt($value)
 * @method static \Illuminate\Database\Query\Builder|Investment withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Investment withoutTrashed()
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|Investment findByUUID($uuid)
 * @property int $account_id
 * @property int|null $agent_id
 * @property int $branch_id
 * @method static \Illuminate\Database\Eloquent\Builder|Investment uuid($uuid)
 * @method static \Illuminate\Database\Eloquent\Builder|Investment whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Investment whereAgentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Investment whereBranchId($value)
 * @property-read mixed $cryptocurrency_string
 * @property-read mixed $withdrawable_amount
 * @property-read \Illuminate\Database\Eloquent\Collection|Withdraw[] $withdraws
 * @property-read int|null $withdraws_count
 */
class Investment extends Model
{
    use UUID, Me, Latest, SoftDeletes;

    protected $fillable = ['account_id', 'agent_id', 'branch_id', 'cryptocurrency', 'initial_deposit', 'amount', 'target', 'matching',
        'invested_at', 'withdraw_at', 'last_change'];

    public function getCryptocurrencyStringAttribute()
    {
        return \App\Helpers\Wallet\Currency::currency($this->cryptocurrency);
    }

    public function withdraws()
    {
        return $this->hasMany(Withdraw::class);
    }

    public function getWithdrawableAmountAttribute()
    {
        $alreadyWithdrawed = $this->withdraws()->whereNotIn('status', [
            Status::REJECTED,
            Status::BLOCKED
        ])->sum('amount');

        return $this->amount - $alreadyWithdrawed;
    }
}
