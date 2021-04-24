<?php

namespace Services\Bookmark\Models;

use App\Concern\Latest;
use App\Concern\Me;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Bookmark
 * @author Sajadweb
 * Sat Jan 09 2021 19:57:43 GMT+0330 (Iran Standard Time)
 */
class Bookmark extends Model
{
    use UUID, SoftDeletes, Latest, Me;

    protected $table = "bookmark";

    protected $guarded = ['id'];

    public function bookmarkable()
    {
        return $this->morphTo();
    }
}
