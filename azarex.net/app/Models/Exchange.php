<?php


namespace App\Models;


use App\Concern\Latest;
use App\Concern\Me;
use App\Concern\PersianDate;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exchange extends Model
{

    use UUID, Me, Latest, PersianDate, SoftDeletes;

    protected $fillable = ['user_id', 'amount', 'description', 'type', 'rate', 'fee', 'transfer_fee', 'transfer_fee_amount',
        'destination', 'wallet_id', 'transaction_id', 'currency'];

}
