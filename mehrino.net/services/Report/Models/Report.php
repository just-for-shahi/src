<?php

namespace Services\Report\Models;

use App\Concern\Latest;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Services\Attachment\Concern\Attachable;
use Services\User\Models\User;

/**
 * Report
 * @author Sajadweb
 * Mon Jan 11 2021 21:18:28 GMT+0330 (Iran Standard Time)
 */
class Report extends Model
{
    use UUID, SoftDeletes, Latest, Attachable;

    protected $table = "report";
    protected $fillable = ['user', 'institutes', 'title', 'content', 'cover', 'status'];

    public function likable()
    {
        return $this->morphTo();
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user');
    }
}
