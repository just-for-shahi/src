<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderEquity extends Model
{
    protected $table = 'order_equities';
    public $timestamps = false;

    protected $fillable = [
        'date_at','account_number', 'pl', 'pips'
    ];
}
