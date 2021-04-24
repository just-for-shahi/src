<?php


namespace App\Http\Controllers\CallRequest;


use App\Concern\Latest;
use App\Concern\Me;
use App\Concern\UUID;
use App\Enums\CallRequest\Status;
use App\Http\Controllers\Account\Account;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Http\Controllers\CallRequest\CallRequest
 *
 * @property string $id
 * @property string $uuid
 * @property int|null $account
 * @property string $phone
 * @property string|null $name
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|CallRequest getLatest(int $page, ?string $search)
 * @method static \Illuminate\Database\Eloquent\Builder|CallRequest me()
 * @method static \Illuminate\Database\Eloquent\Builder|CallRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CallRequest newQuery()
 * @method static \Illuminate\Database\Query\Builder|CallRequest onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CallRequest query()
 * @method static \Illuminate\Database\Eloquent\Builder|CallRequest whereAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CallRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CallRequest whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CallRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CallRequest whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CallRequest wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CallRequest whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CallRequest whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CallRequest whereUuid($value)
 * @method static \Illuminate\Database\Query\Builder|CallRequest withTrashed()
 * @method static \Illuminate\Database\Query\Builder|CallRequest withoutTrashed()
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|CallRequest findByUUID($uuid)
 * @property int|null $account_id
 * @method static \Illuminate\Database\Eloquent\Builder|CallRequest uuid($uuid)
 * @method static \Illuminate\Database\Eloquent\Builder|CallRequest whereAccountId($value)
 * @property-read mixed $is_cancelled
 */
class CallRequest extends Model
{

    use UUID, Me, Latest, SoftDeletes;

    protected $fillable = ['account_id', 'phone', 'name', 'status'];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function getIsCancelledAttribute()
    {
        return $this->status === Status::CANCELED;
    }
}
