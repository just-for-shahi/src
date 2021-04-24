<?php

namespace App\Models;

use App\Models\Member;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class MemberProduct extends Model
{
    protected $table = 'licensing_member_products';

    protected $fillable = ['member_id', 'product_id'];

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($query) {
        });
    }

}
