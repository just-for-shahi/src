<?php


namespace App\Models;


use App\Concern\Me;
use App\Concern\PersianDate;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WalletUser extends Model
{

    use UUID, Me, PersianDate, SoftDeletes;

    protected $table = 'wallet_users';

    protected $fillable = ['user_id', 'wallet_id', 'percent'];

}
