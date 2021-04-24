<?php


namespace App\Http\Controllers\Ticket;


use App\Concern\Latest;
use App\Concern\UUID;
use App\Http\Controllers\Account\Account;
use App\UModels\Attachment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Http\Controllers\Ticket\Ticket
 *
 * @property string $id
 * @property string $uuid
 * @property string $title
 * @property int $priority
 * @property string $message
 * @property int $department
 * @property int $status
 * @property int $seen
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|Attachment[] $attachments
 * @property-read int|null $attachments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|Account[] $me
 * @property-read int|null $me_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Http\Controllers\Ticket\TicketReply[] $replies
 * @property-read int|null $replies_count
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket getLatest(int $page, ?string $search)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket newQuery()
 * @method static \Illuminate\Database\Query\Builder|Ticket onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket query()
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereDepartment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereSeen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket uuid($value)
 * @method static \Illuminate\Database\Query\Builder|Ticket withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Ticket withoutTrashed()
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket findByUUID($uuid)
 * @property-read mixed $can_be_deleted
 * @property-read \App\Http\Controllers\Ticket\TicketAccount|null $ticket_account
 */
class Ticket extends Model
{
    use UUID, Latest, SoftDeletes;

    protected $fillable = ['title', 'priority', 'message', 'department', 'status', 'seen'];

    public function me(): BelongsToMany
    {
        return $this->belongsToMany(Account::class, 'ticket_accounts', "ticket_id", 'account_id')
            ->where("account_id", auth()->id());
    }

    public function replies()
    {
        return $this->hasMany(TicketReply::class, 'ticket_id')->orderBy('created_at', 'asc');
    }

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    public function getCanBeDeletedAttribute()
    {
        return user()->can('access-ticket', $this);
    }

    public function ticket_account()
    {
        return $this->hasOne(TicketAccount::class);
    }
}
