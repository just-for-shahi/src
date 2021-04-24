<?php

namespace Services\Visit\Models;

use App\Concern\Latest;
use App\Concern\Me;
use App\Concern\PersianDate;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Services\User\Models\User;

/**
 * Visit
 * @author Sajadweb
 * Fri Dec 25 2020 02:43:12 GMT+0330 (Iran Standard Time)
 */
class Visit extends Model
{

    use UUID, Me, Latest, PersianDate, SoftDeletes;

    protected $fillable = ['user', 'previous', 'current', 'agent', 'device', 'visitable_id',
        'visitable_type'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user', 'id');
    }
}
