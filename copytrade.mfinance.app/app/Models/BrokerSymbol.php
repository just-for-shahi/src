<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\BrokerSymbol
 *
 * @property string $name
 * @property float|null $spread
 * @property int|null $enabled
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BrokerSymbol enabled()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BrokerSymbol newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BrokerSymbol newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BrokerSymbol query()
 * @mixin \Eloquent
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class BrokerSymbol extends Model
{
    protected $table = 'broker_symbols';

    public function scopeEnabled() {
        return self::where('enabled', 1);
    }
}
