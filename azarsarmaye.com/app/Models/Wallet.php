<?php


namespace App\Models;


use App\Concern\Latest;
use App\Concern\Me;
use App\Concern\PersianDate;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Wallet
 *
 * @property string $id
 * @property string $uuid
 * @property int $user
 * @property int $currency
 * @property string $address
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read string $j_created
 * @property-read string $j_updated
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet findUUID($uuid)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet getLatest($page, $search)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet me()
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet newQuery()
 * @method static \Illuminate\Database\Query\Builder|Wallet onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet query()
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereUuid($value)
 * @method static \Illuminate\Database\Query\Builder|Wallet withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Wallet withoutTrashed()
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet confirmed()
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet uuid($uuid)
 * @property int $user_id
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereUserId($value)
 */
class Wallet extends Model
{
    public const CONFIRMED = 1;
    use UUID, Me, Latest, PersianDate, SoftDeletes;

    protected $fillable = ['user_id', 'currency', 'address', 'status'];

    public function scopeConfirmed($query)
    {
        $query->whereStatus(self::CONFIRMED);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
