<?php

namespace Services\Story\Models;

use App\Concern\Latest;
use App\Concern\Me;
use App\Concern\PersianDate;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Services\Abuses\Concern\Abusable;
use Services\Story\Concern\Expirable;
use Services\User\Models\User;
use Services\Visit\Concern\Visitable;

/**
 * Story
 * @author Sajadweb
 * Fri Dec 25 2020 02:41:52 GMT+0330 (Iran Standard Time)
 */
class Story extends Model
{
    use UUID, Me, Latest, PersianDate, SoftDeletes, Visitable, Expirable, Abusable;

    protected $table = 'stories';

    protected $fillable = ['user', 'intent_type', 'intent_id', 'file'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user', 'id');
    }
}
