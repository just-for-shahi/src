<?php


namespace App\Models;


use App\Concern\PersianDate;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketMessage extends Model
{

    use UUID, PersianDate, SoftDeletes;
    protected $table = 'ticket_replies';
    protected $fillable = ['message_id', 'user_id', 'ticket_id', 'message', 'attachment'];



}
