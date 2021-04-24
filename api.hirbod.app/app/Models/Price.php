<?php


namespace App\Models;


use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Price extends Model
{
    use SoftDeletes , UUID;
    protected $fillable = ['from','till','times','price','special_price','pricable_type', 'pricable_id'];


}