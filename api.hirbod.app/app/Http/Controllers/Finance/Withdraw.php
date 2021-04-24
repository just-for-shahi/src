<?php


namespace App\Http\Controllers\Finance;


use App\Concern\Latest;
use App\Concern\Me;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Withdraw extends Model
{
    use Me, Latest, SoftDeletes;

    protected $fillable = ['uuid', 'user', 'bank_account', 'amount', 'inquiry', 'status'];

}