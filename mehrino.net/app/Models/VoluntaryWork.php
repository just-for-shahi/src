<?php


namespace App\Models;


use App\Concern\Latest;
use App\Concern\Me;
use App\Concern\PersianDate;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Services\Attachment\Concern\Attachable;

class VoluntaryWork extends Model
{

    use UUID, Me, Latest, PersianDate, SoftDeletes, Attachable;

    protected $table = 'voluntary_works';

    protected $fillable = ['user', 'institutes', 'title', 'activity', 'target_audience', 'period',
        'language', 'location', 'latitude', 'longitude', 'address', 'capacity', 'description',
        'from', 'till', 'status'];

}
