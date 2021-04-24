<?php


namespace App\Http\Controllers\Support;


use App\Concern\PersianDate;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CallRequest extends Model
{
    use UUID, PersianDate, SoftDeletes;
    protected $table = 'call_requests';
    protected $fillable = ['uuid', 'user', 'status','token'];

}