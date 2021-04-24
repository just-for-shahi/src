<?php


namespace App\Http\Controllers\Event;


use Illuminate\Database\Eloquent\Model;

class EventScheduling extends Model
{

    protected $table = 'event_scheduling';
    protected $fillable = ['event', 'title', 'from', 'till', 'sort'];

}