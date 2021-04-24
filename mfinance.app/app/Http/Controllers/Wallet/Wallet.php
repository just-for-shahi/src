<?php


namespace App\Http\Controllers\Wallet;


use App\Concern\Latest;
use App\Concern\Me;
use App\Concern\UUID;
use App\Enums\Wallet\Status;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Http\Controllers\Wallet\Wallet
 *
 * @property string $id
 * @property string $uuid
 * @property int $account
 * @property int $currency
 * @property string $address
 * @property int $default
 * @property int $dashboard
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet getLatest(int $page, ?string $search)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet me()
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet newQuery()
 * @method static \Illuminate\Database\Query\Builder|Wallet onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet query()
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereDashboard($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereUuid($value)
 * @method static \Illuminate\Database\Query\Builder|Wallet withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Wallet withoutTrashed()
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet findByUUID($uuid)
 * @property int $account_id
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet uuid($uuid)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereAccountId($value)
 * @property-read mixed $description
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet active()
 */
class Wallet extends Model
{

    use UUID, Me, Latest, SoftDeletes;

    protected $fillable = ['account_id', 'currency', 'address', 'default', 'dashboard', 'status'];

    public function getDescriptionAttribute()
    {
        return \App\Helpers\Wallet\Currency::currency($this->service) .
            '-' . $this->address;
    }

    public function scopeActive($query)
    {
        $query->whereStatus(Status::ACTIVE);
    }
}
