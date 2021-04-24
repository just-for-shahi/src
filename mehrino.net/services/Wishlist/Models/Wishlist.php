<?php

namespace Services\Wishlist\Models;

use App\Concern\Latest;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Wishlist
 * @author Sajadweb
 * Fri Dec 25 2020 02:44:39 GMT+0330 (Iran Standard Time)
 */
class Wishlist extends Model
{
    use UUID, SoftDeletes, Latest;

    protected $guarded = ['id'];
}