<?php


namespace App\Models;


use App\Concern\Latest;
use App\Concern\Me;
use App\Concern\PersianDate;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChatContact extends Model
{

    use UUID, Me, Latest, PersianDate, SoftDeletes;

    protected $table = 'chat_contacts';

    protected $fillable = ['user', 'contact', 'mobile', 'country', 'name'];

}
