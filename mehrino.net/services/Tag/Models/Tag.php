<?php

namespace Services\Tag\Models;

use App\Concern\Latest;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Tag
 * @author Sajadweb
 * Fri Dec 25 2020 02:42:18 GMT+0330 (Iran Standard Time)
 */
class Tag extends Model
{
    use UUID, SoftDeletes, Latest;

    protected $guarded = ['id'];
}