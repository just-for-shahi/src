<?php


namespace App\Models;


use App\Concern\Latest;
use App\Concern\Me;
use App\Concern\PersianDate;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChatReport extends Model
{

    use UUID, Me, Latest, PersianDate, SoftDeletes;

    protected $table = 'chat_reports';

    protected $fillable = ['chat', 'user', 'reported', 'reason', 'level', 'status'];
}
