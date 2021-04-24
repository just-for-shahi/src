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
    protected $fillable = ['title', 'priority', 'message', 'department', 'status','attachment'];

    public function me(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'ticket_users', "ticket_id", 'user_id')->where("user_id", auth()->id());
    }

    public function messages()
    {
        return $this->hasMany(TicketMessage::class, 'ticket_id');
    }
}
