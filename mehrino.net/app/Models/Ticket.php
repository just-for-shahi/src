<?php


namespace App\Models;

use App\Concern\Latest;
use App\Concern\PersianDate;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use UUID, Latest, PersianDate, SoftDeletes;
    protected $fillable = ['title', 'priority', 'message', 'department', 'status'];

    public function me(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'ticket_users', "ticket", 'user')->where("user", auth()->id());
    }

    public function replies()
    {
        return $this->hasMany(TicketReply::class, 'ticket');
    }

    public function attachments(){
        return $this->morphMany(Attachment::class, 'attachable');
    }

}
