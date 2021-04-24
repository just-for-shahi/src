<?php


namespace App\Http\Controllers\BankAccount;


use App\Concern\Latest;
use App\Concern\Me;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Http\Controllers\BankAccount\BankAccount
 *
 * @method static \Illuminate\Database\Eloquent\Builder|BankAccount getLatest(int $page, ?string $search)
 * @method static \Illuminate\Database\Eloquent\Builder|BankAccount me()
 * @method static \Illuminate\Database\Eloquent\Builder|BankAccount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BankAccount newQuery()
 * @method static \Illuminate\Database\Query\Builder|BankAccount onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|BankAccount query()
 * @method static \Illuminate\Database\Query\Builder|BankAccount withTrashed()
 * @method static \Illuminate\Database\Query\Builder|BankAccount withoutTrashed()
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|BankAccount findByUUID($uuid)
 * @method static \Illuminate\Database\Eloquent\Builder|BankAccount uuid($uuid)
 */
class BankAccount extends Model
{
    use UUID, Me, Latest, SoftDeletes;

    protected $table = 'bank_accounts';

    protected $fillable = ['account_id', 'currency', 'iban', 'card', 'no', 'swift', 'status'];
}
