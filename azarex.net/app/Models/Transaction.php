<?php


namespace App\Models;


use App\Concern\Latest;
use App\Concern\Me;
use App\Concern\PersianDate;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{

    use UUID, Me, Latest, PersianDate, SoftDeletes;

    protected $fillable = ['user_id', 'description', 'user_description', 'amount', 'balance', 'type', 'status', 'trace_number',
        'ip', 'bank_account_id', 'payment', 'payment_gateway', 'via', 'currency', 'receipt'];

}
