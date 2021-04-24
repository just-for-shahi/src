<?php


namespace App\Models;


use App\Concern\Latest;
use App\Concern\PersianDate;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rate extends Model
{

    use UUID, Latest, PersianDate, SoftDeletes;

    protected $fillable = ['user_id', 'base', 'currency', 'sell', 'buy', 'description'];

}
