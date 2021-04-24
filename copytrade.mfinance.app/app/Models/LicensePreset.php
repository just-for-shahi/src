<?php

namespace App\Models;

use App\User;
use App\Models\UserBrokerServer;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

/**
 * App\Models\LicensePreset
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property int $expiration_days
 * @property int|null $max_live_accounts
 * @property int|null $max_demo_accounts
 * @property int|null $single_pc
 * @property string|null $broker_name
 * @property int $manager_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $auto_confirm_new_accounts
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserBrokerServer[] $brokers
 * @property-read int|null $brokers_count
 * @property-read \App\User $manager
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LicensePreset newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LicensePreset newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LicensePreset query()
 * @method static whereManagerId(int $id)
 * @mixin \Eloquent
 */
class LicensePreset extends Model
{
    protected $table = 'licensing_presets';

    // protected $fillable = [
    //     'title', 'description', 'expiration_days', 'max_live_accounts', 'max_demo_accounts',
    //     'single_pc', 'manager_id'
    // ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d');
    }

    public function products()
    {
        return $this->belongsToMany(
            Product::class,
            'licensing_preset_products', 'preset_id', 'product_id');
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function brokers()
    {
        return $this->belongsToMany(UserBrokerServer::class, 'licensing_preset_brokers',
            'broker_name', 'broker_name');
    }

}
