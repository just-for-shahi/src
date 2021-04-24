<?php


namespace App\Models;


use App\Concern\Latest;
use App\Concern\Me;
use App\Concern\PersianDate;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wallet extends Model
{

    use UUID, Latest, Me, PersianDate, SoftDeletes;

    protected $fillable = ['address', 'name', 'network', 'type', 'currency', 'public', 'private'];

}
