<?php

namespace Services\Status\Models;

use App\Concern\Distance;
use App\Concern\Latest;
use App\Concern\Me;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Status
 * @author Sajadweb
 * Sat Jan 09 2021 19:57:43 GMT+0330 (Iran Standard Time)
 */
class Status extends Model
{
    use Distance, UUID, SoftDeletes, Latest, Me;

    protected $table = 'status';

    protected $guarded = ['id'];

    protected $fillable = [
        'uuid', 'user', 'statusable_type', 'statusable_id', 'status'
    ];

    public function statusable()
    {
        return $this->morphTo()->distance(x_lat(), x_long())->whereStatus(config('mehrino.default_status.show'));
    }
}
