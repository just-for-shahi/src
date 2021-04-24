<?php

namespace Services\Follow\Models;

use App\Concern\Latest;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *Follow
 * @author Sajadweb
 * Sat Jan 09 2021 19:57:43 GMT+0330 (Iran Standard Time)
 */
class Follow extends Model
{
    use UUID, SoftDeletes, Latest;

    protected $table = "follows";

    protected $guarded = ['id'];

    public function followable()
    {
        return $this->morphTo();
    }
}
