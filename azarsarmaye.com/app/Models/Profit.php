<?php


namespace App\Models;


use App\Concern\Latest;
use App\Concern\Me;
use App\Concern\PersianDate;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Profit
 *
 * @property string $id
 * @property string $uuid
 * @property string $token
 * @property int $account
 * @property int $investment
 * @property int $amount
 * @property int $balance
 * @property int $equity
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read string $j_created
 * @property-read string $j_updated
 * @method static \Illuminate\Database\Eloquent\Builder|Profit findUUID($uuid)
 * @method static \Illuminate\Database\Eloquent\Builder|Profit getLatest($page, $search)
 * @method static \Illuminate\Database\Eloquent\Builder|Profit me()
 * @method static \Illuminate\Database\Eloquent\Builder|Profit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Profit newQuery()
 * @method static \Illuminate\Database\Query\Builder|Profit onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Profit query()
 * @method static \Illuminate\Database\Eloquent\Builder|Profit whereAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profit whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profit whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profit whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profit whereEquity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profit whereInvestment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profit whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profit whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profit whereUuid($value)
 * @method static \Illuminate\Database\Query\Builder|Profit withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Profit withoutTrashed()
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|Profit uuid($uuid)
 */
class Profit extends Model
{

    use UUID, Latest, PersianDate, SoftDeletes, Me;

    protected $fillable = ['token', 'account', 'investment', 'amount', 'balance', 'equity'];

}
