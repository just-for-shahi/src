<?php


namespace App\Http\Controllers\Ticket;


use App\Http\Controllers\Account\Account;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Http\Controllers\Ticket\TicketAccount
 *
 * @property int $account
 * @property int $ticket
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|TicketAccount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketAccount newQuery()
 * @method static \Illuminate\Database\Query\Builder|TicketAccount onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketAccount query()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketAccount whereAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketAccount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketAccount whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketAccount whereTicket($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketAccount whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|TicketAccount withTrashed()
 * @method static \Illuminate\Database\Query\Builder|TicketAccount withoutTrashed()
 * @mixin \Eloquent
 * @property int $account_id
 * @property int $ticket_id
 * @method static \Illuminate\Database\Eloquent\Builder|TicketAccount whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketAccount whereTicketId($value)
 */
class TicketAccount extends Model
{
    use SoftDeletes;

    protected $table = 'ticket_accounts';
    protected $fillable = ['ticket_id', 'account_id'];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
