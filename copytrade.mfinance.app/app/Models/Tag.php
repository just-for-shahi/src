<?php

namespace App\Models;

use App\User;
use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use DefaultDatetimeFormat;

    protected $table = 'tags';

    //protected $fillable = ['title', 'color', 'manager_id', 'enabled'];

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

}
