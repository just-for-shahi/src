<?php


namespace App\UModels;


use Illuminate\Database\Eloquent\Model;

/**
 * App\UModels\Branch
 *
 * @property int $id
 * @property string $uuid
 * @property string $code
 * @property int $account
 * @property string $name
 * @property string $open
 * @property string $country
 * @property string $province
 * @property string $city
 * @property string|null $phone
 * @property string|null $zip
 * @property string $services
 * @property string $status
 * @property string|null $latitude
 * @property string|null $longitude
 * @property string|null $website
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Branch newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Branch newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Branch query()
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereOpen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereServices($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereWebsite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereZip($value)
 * @mixin \Eloquent
 * @property int $account_id
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereAccountId($value)
 */
class Branch extends Model
{

    protected $fillable = ['code', 'account_id', 'name', 'open', 'country', 'province', 'city', 'phone', 'zip', 'services',
        'status', 'latitude', 'longitude', 'website'];

}
