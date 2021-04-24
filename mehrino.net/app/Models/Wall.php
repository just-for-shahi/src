<?php


namespace App\Models;


use App\Concern\Latest;
use App\Concern\Me;
use App\Concern\PersianDate;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Services\Attachment\Concern\Attachable;

class Wall extends Model
{

    use UUID, Me, Latest, PersianDate, SoftDeletes , Attachable;

    protected $fillable = ['user', 'institutes', 'title', 'cover', 'description', 'latitude', 'longitude',
        'type', 'private', 'status'];

}
