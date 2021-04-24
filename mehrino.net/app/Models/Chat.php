<?php


namespace App\Models;


use App\Concern\Latest;
use App\Concern\Me;
use App\Concern\PersianDate;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chat extends Model
{

    use UUID, Me, Latest, PersianDate, SoftDeletes;

    protected $fillable = ['user', 'chatable_id', 'chatable_type', 'title', 'description', 'logo',
        'pinned', 'username', 'type', 'private', 'status'];

}
