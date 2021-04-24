<?php


namespace App\Models;


use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketUser extends Model
{

    use UUID, SoftDeletes;
    protected $table = 'ticket_users';
    protected $fillable = ['ticket_id', 'user_id'];

}
