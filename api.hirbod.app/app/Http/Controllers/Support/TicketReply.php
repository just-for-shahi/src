<?php


namespace App\Http\Controllers\Support;


use App\Concern\PersianDate;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketReply extends Model
{
    use UUID, PersianDate, SoftDeletes;
    protected $table = 'ticket_replies';
    protected $fillable = ['uuid', 'user', 'ticket', 'message'];
}