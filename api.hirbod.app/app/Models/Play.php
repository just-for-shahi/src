<?php


namespace App\Models;


use App\Concern\Latest;
use App\Concern\Me;
use App\Concern\PersianDate;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;

class Play extends Model
{
    use UUID, Me, Latest, PersianDate;

    protected $fillable = ['user', 'user_agent', 'playable_type', 'playable_id', 'times', 'last_seen'];

}