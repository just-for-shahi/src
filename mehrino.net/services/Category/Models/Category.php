<?php

namespace Services\Category\Models;

use App\Concern\Latest;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Category
 * @author Sajadweb
 * Fri Dec 25 2020 02:37:20 GMT+0330 (Iran Standard Time)
 */
class Category extends Model
{
    use UUID, SoftDeletes, Latest;

    protected $guarded = ['id'];
}