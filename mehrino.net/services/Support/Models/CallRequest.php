<?php

namespace Services\Support\Models;

use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * CallRequest
 * @author Sajadweb
 * 2020-06-12 04:19:10
 */
class CallRequest extends Model
{
    use UUID, SoftDeletes;
    protected $table = 'call_requests';
    protected $fillable = ['uuid', 'name', 'phone', 'message','status'];
}
