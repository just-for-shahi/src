<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;
use App\Models\Product;

/**
 * App\Models\ProductOption
 *
 * @method static whereProductId($productId)
 * @property int $id
 * @property int|null $product_id
 * @property string $pkey
 * @property string $val
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $enabled
 * @property-read \App\Models\Product|null $product
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductOption newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductOption newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductOption query()
 * @mixin \Eloquent
 */
class ProductOption extends Model
{
    protected $table = 'licensing_product_options';

    protected $fillable = ['pkey','val','enabled'];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d');
    }

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }

}
