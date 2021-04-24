<?php


namespace App\Models;


use App\Concern\Latest;
use App\Concern\Me;
use App\Concern\PersianDate;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Withdraw
 *
 * @property string $id
 * @property string $uuid
 * @property int $user
 * @property int $wallet
 * @property int $account
 * @property int $amount
 * @property string|null $inquiry
 * @property int $status
 * @property string|null $receipt
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read string $j_created
 * @property-read string $j_updated
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw findUUID($uuid)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw getLatest($page, $search)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw latest()
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
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereReceipt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereWallet($value)
 * @method static \Illuminate\Database\Query\Builder|Withdraw withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Withdraw withoutTrashed()
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw uuid($uuid)
 * @property int $user_id
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereUserId($value)
 */
class Withdraw extends Model
{
    use Latest, UUID, PersianDate, Me, SoftDeletes;
    protected $fillable = ['user_id', 'wallet', 'account', 'amount', 'inquiry', 'status', 'receipt'];

    public function scopeLatest(){
        return $this->orderBy('created_at', 'desc');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
