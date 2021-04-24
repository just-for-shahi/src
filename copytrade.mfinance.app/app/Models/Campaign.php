<?php

namespace App\Models;

use App\Models\Licensing;
use App\Models\Product;
use App\User;
use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use DefaultDatetimeFormat;

    protected $table = 'licensing_campaigns';

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function users()
    {
        return $this->belongsToMany( User::class, Licensing::class, 'campaign_id', 'user_id')->withPivot('reference_source');
    }

    public function products()
    {
        return $this->belongsToMany(
            Product::class,
            'licensing_campaign_products', 'campaign_id', 'product_id');
    }

}
