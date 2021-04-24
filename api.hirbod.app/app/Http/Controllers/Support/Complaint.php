<?php


namespace App\Http\Controllers\Support;


use App\Concern\PersianDate;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Complaint extends Model
{
    use UUID, PersianDate, SoftDeletes;
    protected $fillable = ['uuid', 'user', 'content', 'status','token'];

}