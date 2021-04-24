<?php


namespace App\Models;


use App\Concern\Latest;
use App\Concern\Me;
use App\Concern\PersianDate;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Institute extends Model
{

    use UUID, Me, Latest, PersianDate, SoftDeletes;

    protected $table = 'institutes';

    protected $fillable = ['user', 'title', 'type', 'logo', 'website', 'email', 'linkedin', 'youtube', 'instagram',
        'telegram', 'aparat', 'whatsapp', 'phone', 'registered', 'created', 'registered_no', 'registered_name',
        'license_no', 'license_expire', 'license_provider', 'address', 'statute', 'activity_range', 'ceo',
        'license_file', 'statute_file', 'status', 'latitude', 'longitude', 'covered_persons'];
}
