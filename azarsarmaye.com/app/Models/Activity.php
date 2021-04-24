<?php


namespace App\Models;


use App\Concern\Latest;
use App\Concern\Me;
use App\Concern\PersianDate;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Activity
 *
 * @property string $id
 * @property string $uuid
 * @property int $user
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $j_created
 * @property-read string $j_updated
 * @method static \Illuminate\Database\Eloquent\Builder|Activity findUUID($uuid)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity getLatest($page, $search)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity me()
 * @method static \Illuminate\Database\Eloquent\Builder|Activity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Activity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Activity query()
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereUuid($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|Activity uuid($uuid)
 * @property int $user_id
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereUserId($value)
 */
class Activity extends Model
{

    use UUID, Me, Latest, PersianDate;

    protected $table = 'activities';

    protected $fillable = ['user_id', 'description'];

}
