<?php


namespace Services\Support\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketUser  extends Model
{

    use SoftDeletes;

    protected $table = 'ticket_users';

     protected $fillable = ['user', 'ticket'];
}
