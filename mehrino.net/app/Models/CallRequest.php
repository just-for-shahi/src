<?php


namespace App\Models;


use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CallRequest extends Model
{

    use UUID, SoftDeletes;

    protected $table = 'call_requests';

    protected $fillable = ['name', 'phone', 'status'];

}
