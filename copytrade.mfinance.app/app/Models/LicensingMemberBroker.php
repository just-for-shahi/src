<?php

namespace App\Models;

use App\Models\Member;
use Illuminate\Database\Eloquent\Model;

class LicensingMemberBroker extends Model
{
    protected $table = 'licensing_member_brokers';


    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
