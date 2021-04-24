<?php


namespace Services\Support\Models;


use App\Concern\Latest;
use App\Concern\Me;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Services\Attachment\Concern\Attachable;
use Services\User\Models\User;

class TicketReply extends Model
{

    use UUID, Me, Latest, SoftDeletes, Attachable;

    protected $table = 'ticket_replies';

    protected $fillable = ['uuid', 'ticket', 'user', 'reply', 'message'];

    public function my()
    {
        return $this->belongsTo(User::class, 'user');
    }

    public function reply()
    {
        return $this->belongsTo(TicketReply::class, 'reply');
    }

    public function replies()
    {
        return $this->hasMany(TicketReply::class, 'reply');
    }
}
