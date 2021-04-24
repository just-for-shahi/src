<?php


namespace App\Models;


use App\Concern\Latest;
use App\Concern\Me;
use App\Concern\PersianDate;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlueTick extends Model
{

    use UUID, Me, Latest, PersianDate, SoftDeletes;

    protected $table = 'blue_ticks';

    protected $fillable = ['user', 'passport', 'purpose', 'youtube', 'twitter', 'instagram', 'reject', 'status'];

}
