<?php


namespace App\Http\Controllers\Event;


use Illuminate\Database\Eloquent\Model;

class EventSponsor extends Model
{

    protected $table = 'event_sponsors';
    protected $fillable = ['event', 'name', 'logo', 'website', 'instagram', 'telegram', 'sort'];

}