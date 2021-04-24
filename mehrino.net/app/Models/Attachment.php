<?php


namespace App\Models;


use App\Concern\Latest;
use App\Concern\Me;
use App\Concern\PersianDate;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attachment extends Model
{

    use UUID, PersianDate, Me, Latest, SoftDeletes;

    protected $fillable = ['user', 'path', 'attachable_type', 'attachable_id'];

}
