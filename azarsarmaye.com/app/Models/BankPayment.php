<?php


namespace App\Models;


use App\Concern\Latest;
use App\Concern\Me;
use App\Concern\PersianDate;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\BankPayment
 *
 * @property string $id
 * @property string $uuid
 * @property int $user
 * @property int $account
 * @property int|null $transaction
 * @property int $bank_account
 * @property int $amount
 * @property string|null $receipt
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read string $j_created
 * @property-read string $j_updated
 * @method static \Illuminate\Database\Eloquent\Builder|BankPayment findUUID($uuid)
 * @method static \Illuminate\Database\Eloquent\Builder|BankPayment getLatest($page, $search)
 * @method static \Illuminate\Database\Eloquent\Builder|BankPayment me()
 * @method static \Illuminate\Database\Eloquent\Builder|BankPayment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BankPayment newQuery()
 * @method static \Illuminate\Database\Query\Builder|BankPayment onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|BankPayment query()
 * @method static \Illuminate\Database\Eloquent\Builder|BankPayment whereAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankPayment whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankPayment whereBankAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankPayment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankPayment whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankPayment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankPayment whereReceipt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankPayment whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankPayment whereTransaction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankPayment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankPayment whereUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankPayment whereUuid($value)
 * @method static \Illuminate\Database\Query\Builder|BankPayment withTrashed()
 * @method static \Illuminate\Database\Query\Builder|BankPayment withoutTrashed()
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|BankPayment uuid($uuid)
 * @property int $user_id
 * @method static \Illuminate\Database\Eloquent\Builder|BankPayment whereUserId($value)
 */
class BankPayment extends Model
{

    use Me, Latest, PersianDate, UUID, SoftDeletes;

    protected $table = 'bank_payments';
    protected $fillable = ['user_id', 'account', 'transaction', 'bank_account', 'amount', 'receipt', 'status'];

}
