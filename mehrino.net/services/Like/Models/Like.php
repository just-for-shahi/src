<?php

namespace Services\Like\Models;

use App\Concern\Latest;
use App\Concern\Me;
use App\Concern\PersianDate;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Like
 * @author Sajadweb
 * Fri Dec 25 2020 02:40:00 GMT+0330 (Iran Standard Time)
 */
class Like extends Model
{
    use UUID, Me, Latest, PersianDate, SoftDeletes;

    protected $fillable = ['user', 'action', 'likable_id', 'likable_type'];

    public function likable()
    {
        return $this->morphTo();
    }
}
