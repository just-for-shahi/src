<?php


namespace App\Http\Controllers\MAccount;


use App\Concern\Latest;
use App\Concern\Me;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Http\Controllers\MAccount\MAccount
 *
 * @property string $id
 * @property string $uuid
 * @property int $account_id
 * @property int|null $investment
 * @property int $broker
 * @property string|null $username
 * @property string|null $password
 * @property string|null $investor_password
 * @property string|null $server
 * @property int|null $balance
 * @property int|null $equity
 * @property int $harvestable
 * @property int $account_type
 * @property int $report
 * @property int $dashboard
 * @property int $trading_system
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|MAccount getLatest(int $page, ?string $search)
 * @method static \Illuminate\Database\Eloquent\Builder|MAccount me()
 * @method static \Illuminate\Database\Eloquent\Builder|MAccount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MAccount newQuery()
 * @method static \Illuminate\Database\Query\Builder|MAccount onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|MAccount query()
 * @method static \Illuminate\Database\Eloquent\Builder|MAccount whereAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MAccount whereAccountType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MAccount whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MAccount whereBroker($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MAccount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MAccount whereDashboard($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MAccount whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MAccount whereEquity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MAccount whereHarvestable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MAccount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MAccount whereInvestment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MAccount whereInvestorPassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MAccount wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MAccount whereReport($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MAccount whereServer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MAccount whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MAccount whereTradingSystem($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MAccount whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MAccount whereUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MAccount whereUuid($value)
 * @method static \Illuminate\Database\Query\Builder|MAccount withTrashed()
 * @method static \Illuminate\Database\Query\Builder|MAccount withoutTrashed()
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|MAccount findByUUID($uuid)
 * @property int $account_id
 * @property int|null $investment_id
 * @method static \Illuminate\Database\Eloquent\Builder|MAccount uuid($uuid)
 * @method static \Illuminate\Database\Eloquent\Builder|MAccount whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MAccount whereInvestmentId($value)
 */
class MAccount extends Model
{

    use UUID, Me, Latest, SoftDeletes;

    protected $table = 'maccounts';

    protected $fillable = ['account_id', 'investment_id', 'broker', 'username', 'password', 'investor_password', 'server', 'balance', 'equity',
        'harvestable', 'account_type', 'report', 'dashboard', 'ea', 'status'];

}
