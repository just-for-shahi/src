<?php


namespace App\Models;


use App\Concern\Latest;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventSpeaker extends Model
{

    use UUID, Latest, SoftDeletes;

    protected $table = 'event_speakers';

    protected $fillable = ['event', 'name', 'avatar', 'bio', 'website', 'instagram', 'telegram', 'sort'];

}
