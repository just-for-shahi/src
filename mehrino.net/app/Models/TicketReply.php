<?php


namespace App\Models;

use App\Concern\PersianDate;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketReply extends Model
{
    use UUID, PersianDate, SoftDeletes;
    protected $table = 'ticket_replies';
    protected $fillable = ['user', 'ticket', 'message'];
}
