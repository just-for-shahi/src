<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Licensing extends Model
{
    protected $table = 'licensing_users';
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

}
