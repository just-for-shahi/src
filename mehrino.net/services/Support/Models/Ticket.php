<?php

namespace Services\Support\Models;

use App\Concern\Latest;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Services\Support\Enum\Status;
use Services\User\Models\User;

/**
 * Ticket
 * @property mixed id
 * @author Sajadweb
 * 2020-06-06 09:50:45
 */
class Ticket extends Model
{
    use UUID, Latest, SoftDeletes;
    protected $fillable = ['uuid', 'title', 'priority', 'message', 'department', 'status'];

    public function my_ticket(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'ticket_users', "ticket", 'user')
            ->where('id', auth('api')->id());
    }

    public function replies()
    {
        return $this->hasMany(TicketReply::class, 'ticket')->whereNull('reply');
    }

    public function getStatusAttribute($value): string
    {
        return status_to_str($value);
    }

    public function getDepartmentAttribute($value): string
    {
        return dep_to_str($value);
    }

    public function scopeDoesntClose($query)
    {
        return $query
            ->whereNotIn('status', [Status::UserClose, Status::ManagerClose]);
    }
}
