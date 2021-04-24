<?php

namespace App\Models;

use App\User;
use App\Models\ProductOption;
use App\Models\ProductFile;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;
use Encore\Admin\Traits\DefaultDatetimeFormat;

class Product extends Model
{
    use DefaultDatetimeFormat;

    protected $table = 'licensing_products';

    protected $fillable = ['key', 'title', 'description', 'manager_id'];

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function opts()
    {
        return $this->hasMany(ProductOption::class);
    }

    public function files()
    {
        return $this->hasMany(ProductFile::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($query) {
        });
    }

}
