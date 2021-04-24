<?php


namespace App\Models;


use App\Concern\Latest;
use App\Concern\PersianDate;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;

class InstituteBoardMember extends Model
{

    use UUID, Latest, PersianDate;

    protected $table = 'institute_board_members';

    protected $fillable = ['institutes', 'name', 'position', 'introduction', 'avatar', 'website',
        'instagram', 'telegram', 'aparat', 'linkedin'];

}
