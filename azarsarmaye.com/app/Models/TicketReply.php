<?php


namespace App\Models;


use App\Concern\Latest;
use App\Concern\PersianDate;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\TicketReply
 *
 * @property string $id
 * @property string $uuid
 * @property int $user
 * @property int $ticket
 * @property string $message
 * @property string|null $attachment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $j_created
 * @property-read string $j_updated
 * @method static \Illuminate\Database\Eloquent\Builder|TicketReply findUUID($uuid)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketReply getLatest($page, $search)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketReply newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketReply newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketReply query()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketReply whereAttachment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketReply whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketReply whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketReply whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketReply whereTicket($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketReply whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketReply whereUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketReply whereUuid($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|TicketReply uuid($uuid)
 * @property int $user_id
 * @method static \Illuminate\Database\Eloquent\Builder|TicketReply whereUserId($value)
 */
class TicketReply extends Model
{
    use UUID, Latest, PersianDate;

    protected $table = 'ticket_replies';
    protected $fillable = ['user_id', 'ticket', 'message', 'attachment'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
