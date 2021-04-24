<?php


namespace App\Http\Controllers\Event;


use App\Concern\PersianDate;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventSpeaker extends Model
{
    use UUID , PersianDate, SoftDeletes;

    protected $table = 'event_speakers';
    protected $fillable = ['event', 'name', 'avatar', 'bio', 'website', 'instagram', 'telegram', 'sort'];

}