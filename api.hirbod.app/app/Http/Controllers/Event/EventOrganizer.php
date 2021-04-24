<?php


namespace App\Http\Controllers\Event;


use Illuminate\Database\Eloquent\Model;

class EventOrganizer extends Model
{

    protected $table = 'event_organizers';
    protected $fillable = ['event', 'name', 'logo', 'website', 'instagram', 'telegram', 'sort'];

}