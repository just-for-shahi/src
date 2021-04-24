<?php


namespace App\Models;


use App\Concern\Latest;
use App\Concern\Me;
use App\Concern\PersianDate;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Story extends Model
{

    use UUID, Me, Latest, PersianDate, SoftDeletes;

    protected $table = 'stories';

    protected $fillable = ['user', 'intent_type', 'intent_id', 'file'];

}
