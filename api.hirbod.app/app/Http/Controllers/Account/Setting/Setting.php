<?php


namespace App\Http\Controllers\V1\Rest\Account\Setting;


use App\Concern\UUID;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;

class Setting extends Model
{
    use UUID;
    protected $fillable = ['uuid', 'user', 'theme', 'kids_mode', 'notifications', 'sms', 'ads'];

    public function scopeMe(Builder $query){

      return $query->where('user',auth()->user()->id);
    }

}