<?php

namespace Services\BankAccount\Models;

use App\Concern\Latest;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * BankAccount
 * @author Sajadweb
 * Sun Dec 27 2020 13:30:10 GMT+0330 (Iran Standard Time)
 */
class BankAccount extends Model
{
    use UUID, SoftDeletes, Latest;

    protected $guarded = ['id'];
}