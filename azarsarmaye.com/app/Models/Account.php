<?php


namespace App\Models;


use App\Concern\Latest;
use App\Concern\Me;
use App\Concern\PersianDate;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Account
 *
 * @property string $id
 * @property string $uuid
 * @property int $user
 * @property int $no
 * @property string $name
 * @property int $color
 * @property int $balance
 * @property int $growth
 * @property int $harvestable
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read string $j_created
 * @property-read string $j_updated
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Investment[] $investments
 * @property-read int|null $investments_count
 * @method static \Illuminate\Database\Eloquent\Builder|Account findUUID($uuid)
 * @method static \Illuminate\Database\Eloquent\Builder|Account getLatest($page, $search)
 * @method static \Illuminate\Database\Eloquent\Builder|Account me()
 * @method static \Illuminate\Database\Eloquent\Builder|Account newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Account newQuery()
 * @method static \Illuminate\Database\Query\Builder|Account onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Account query()
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereGrowth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereHarvestable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereUuid($value)
 * @method static \Illuminate\Database\Query\Builder|Account withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Account withoutTrashed()
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|Account uuid($uuid)
 * @property int $user_id
 * @property-read mixed $is_confirmed
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereUserId($value)
 */
class Account extends Model
{
    public const CONFIRMED = 0;

    use UUID, Me, PersianDate, Latest, SoftDeletes;

    protected $fillable = ['user_id', 'no', 'name', 'color', 'balance', 'growth', 'harvestable', 'status'];

    public function investments(): HasMany
    {
        return $this->hasMany(Investment::class, 'account')->where('status', 1);
    }

    public function getIsConfirmedAttribute()
    {
        return $this->status == self::CONFIRMED;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
