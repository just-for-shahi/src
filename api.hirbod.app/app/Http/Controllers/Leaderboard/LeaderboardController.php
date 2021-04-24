<?php


namespace App\Http\Controllers\Leaderboard;


use App\Http\Controllers\Controller;

class LeaderboardController extends Controller
{

    private $obj, $objRec;

    public function __construct()
    {
        $this->obj = new Leaderboard();
        $this->objRec = new LeaderboardRecord();
    }

}