<?php


namespace App\Models;


use App\Concern\Latest;
use App\Concern\Me;
use App\Concern\PersianDate;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Like extends Model
{
    use UUID, Me, PersianDate, Latest, SoftDeletes;
    protected $fillable = ['user', 'likable_type', 'likable_id' , 'status'];

}