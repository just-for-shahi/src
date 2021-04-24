<?php


namespace App\Models;


use App\Concern\Latest;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventSponsor extends Model
{

    use UUID, Latest, SoftDeletes;

    protected $table = 'event_sponsors';

    protected $fillable = ['event', 'name', 'logo', 'website', 'instagram', 'telegram', 'sort'];
}
