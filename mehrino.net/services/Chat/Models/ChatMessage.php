<?php


namespace Services\Chat\Models;


use App\Concern\Latest;
use App\Concern\Me;
use App\Concern\PersianDate;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Services\User\Concern\BelongsToUser;

class ChatMessage extends Model
{

    use UUID, Me, Latest, PersianDate, SoftDeletes, BelongsToUser;

    protected $table = 'chat_messages';

    protected $fillable = ['chat', 'user', 'reply', 'message'];

}
