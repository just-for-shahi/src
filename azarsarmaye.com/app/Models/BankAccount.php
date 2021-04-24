<?php


namespace App\Models;


use App\Concern\Latest;
use App\Concern\Me;
use App\Concern\PersianDate;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\BankAccount
 *
 * @property string $id
 * @property string $uuid
 * @property string $iban
 * @property string|null $card
 * @property string|null $account
 * @property string $photo
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read string $j_created
 * @property-read string $j_updated
 * @method static \Illuminate\Database\Eloquent\Builder|BankAccount findUUID($uuid)
 * @method static \Illuminate\Database\Eloquent\Builder|BankAccount getLatest($page, $search)
 * @method static \Illuminate\Database\Eloquent\Builder|BankAccount me()
 * @method static \Illuminate\Database\Eloquent\Builder|BankAccount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BankAccount newQuery()
 * @method static \Illuminate\Database\Query\Builder|BankAccount onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|BankAccount query()
 * @method static \Illuminate\Database\Eloquent\Builder|BankAccount whereAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankAccount whereCard($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankAccount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankAccount whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankAccount whereIban($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankAccount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankAccount wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankAccount whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankAccount whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankAccount whereUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankAccount whereUuid($value)
 * @method static \Illuminate\Database\Query\Builder|BankAccount withTrashed()
 * @method static \Illuminate\Database\Query\Builder|BankAccount withoutTrashed()
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|BankAccount uuid($uuid)
 * @property int $user_id
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|BankAccount whereUserId($value)
 */
class BankAccount extends Model
{
    public const CONFIRMED = 1;

    use UUID, Latest, Me, PersianDate, SoftDeletes;
    protected $table = 'bank_accounts';
    protected $fillable = ['user_id', 'iban', 'card', 'account', 'photo', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
