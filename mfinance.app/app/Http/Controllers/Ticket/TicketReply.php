<?php


namespace App\Http\Controllers\Ticket;


use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Http\Controllers\Ticket\TicketReply
 *
 * @property string $id
 * @property string $uuid
 * @property int $ticket
 * @property int $account
 * @property int|null $reply
 * @property string $message
 * @property int $seen
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|TicketReply newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketReply newQuery()
 * @method static \Illuminate\Database\Query\Builder|TicketReply onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketReply query()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketReply whereAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketReply whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketReply whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketReply whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketReply whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketReply whereReply($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketReply whereSeen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketReply whereTicket($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketReply whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketReply whereUuid($value)
 * @method static \Illuminate\Database\Query\Builder|TicketReply withTrashed()
 * @method static \Illuminate\Database\Query\Builder|TicketReply withoutTrashed()
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|TicketReply findByUUID($uuid)
 * @property int $ticket_id
 * @property int $account_id
 * @property int|null $reply_id
 * @method static \Illuminate\Database\Eloquent\Builder|TicketReply uuid($uuid)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketReply whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketReply whereReplyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketReply whereTicketId($value)
 */
class TicketReply extends Model
{
    use UUID, SoftDeletes;
    protected $table = 'ticket_replies';
    protected $fillable = ['account_id', 'ticket_id', 'message', 'seen'];
}
