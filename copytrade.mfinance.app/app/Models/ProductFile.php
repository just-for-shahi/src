<?php

namespace App\Models;

use App\Models\Product;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ProductFile
 *
 * @property int $id
 * @property string $name
 * @property string $path
 * @property int $product_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductFile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductFile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductFile query()
 * @mixin \Eloquent
 * @property string|null $type
 */
class ProductFile extends Model
{
    protected $table = 'licensing_product_files';

    protected $fillable = ['name','path','product_id', 'type'];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d');
    }

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }

}
