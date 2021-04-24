<?php


namespace App\Http\Controllers\Leaderboard;


use App\Concern\Latest;
use App\Concern\Me;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeaderboardRecord extends Model
{

    use Me, Latest, SoftDeletes;

    protected $table = 'leaderboard_records';

    protected $fillable = ['uuid', 'leaderboard', 'user', 'action', 'number', 'before', 'after'];

}