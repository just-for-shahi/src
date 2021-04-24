<?php


namespace App\Models;


use App\Concern\Latest;
use App\Concern\Me;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\CallRequest
 *
 * @property string $id
 * @property string $uuid
 * @property int|null $user
 * @property string|null $name
 * @property string $phone
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|CallRequest findUUID($uuid)
 * @method static \Illuminate\Database\Eloquent\Builder|CallRequest getLatest($page, $search)
 * @method static \Illuminate\Database\Eloquent\Builder|CallRequest me()
 * @method static \Illuminate\Database\Eloquent\Builder|CallRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CallRequest newQuery()
 * @method static \Illuminate\Database\Query\Builder|CallRequest onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CallRequest query()
 * @method static \Illuminate\Database\Eloquent\Builder|CallRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CallRequest whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CallRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CallRequest whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CallRequest wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CallRequest whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CallRequest whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CallRequest whereUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CallRequest whereUuid($value)
 * @method static \Illuminate\Database\Query\Builder|CallRequest withTrashed()
 * @method static \Illuminate\Database\Query\Builder|CallRequest withoutTrashed()
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|CallRequest uuid($uuid)
 * @property int|null $user_id
 * @method static \Illuminate\Database\Eloquent\Builder|CallRequest whereUserId($value)
 */
class CallRequest extends Model
{
    use UUID, Me, Latest, UUID, SoftDeletes;
    protected $table = 'call_requests';
    protected $fillable = ['user_id', 'name', 'phone', 'status'];

}
