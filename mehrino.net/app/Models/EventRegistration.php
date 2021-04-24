<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventRegistration extends Model
{

    protected $table = 'event_registrations';
    protected $fillable = ['user', 'event', 'price', 'factor', 'status'];

}
