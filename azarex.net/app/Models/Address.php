<?php


namespace App\Models;


use App\Concern\Latest;
use App\Concern\Me;
use App\Concern\PersianDate;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{

    use UUID, Me, Latest, PersianDate, SoftDeletes;

    protected $table = 'addresses';

    protected $fillable = ['user_id', 'type', 'address', 'city', 'state', 'postal_code', 'status'];

}
