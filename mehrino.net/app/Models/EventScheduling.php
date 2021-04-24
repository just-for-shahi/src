<?php


namespace App\Models;


use App\Concern\Latest;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventScheduling extends Model
{

    use UUID, Latest, SoftDeletes;

    protected $table = 'event_scheduling';

    protected $fillable = ['event', 'title', 'from', 'till', 'sort'];
}
