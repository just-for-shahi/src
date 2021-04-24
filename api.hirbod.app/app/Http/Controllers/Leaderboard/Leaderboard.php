<?php


namespace App\Http\Controllers\Leaderboard;


use App\Concern\Latest;
use App\Concern\Me;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Leaderboard extends Model
{

    use Me, Latest, SoftDeletes;

    protected $fillable = ['uuid', 'user', 'name', 'type', 'achievement', 'points', 'rank', 'amount', 'status'];

}