<?php


namespace App\Models;

use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventOrganizer extends Model
{

    use UUID, SoftDeletes;

    protected $table = 'event_organizers';
    protected $fillable = ['event', 'title', 'logo', 'website', 'instagram', 'telegram', 'sort'];

}
