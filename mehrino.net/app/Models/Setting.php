<?php


namespace App\Models;


use App\Concern\Me;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{

    use Me, SoftDeletes;

    protected $fillable = ['user', 'theme', 'kids_mode', 'notifications', 'sms', 'ads'];

}
