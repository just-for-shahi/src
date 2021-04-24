<?php


namespace App\Models;


use App\Concern\Latest;
use App\Concern\Me;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wishlist extends Model
{
    use Me, Latest, SoftDeletes;
    protected $fillable = ['user', 'wishlistable_type', 'wishlistable_id'];




}