<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketUser extends Model
{
    use SoftDeletes;
    protected $table = 'ticket_users';
    protected $fillable = ['ticket', 'user'];

}
