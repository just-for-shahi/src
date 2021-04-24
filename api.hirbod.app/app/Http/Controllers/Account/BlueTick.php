<?php


namespace App\Http\Controllers\Account;


use App\Concern\Latest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlueTick extends Model
{
    use Latest, SoftDeletes;

    protected $table = 'blue_ticks';

    protected $fillable = ['uuid', 'user', 'passport', 'purpose', 'youtube', 'twitter', 'instagram', 'reject', 'status'];
}