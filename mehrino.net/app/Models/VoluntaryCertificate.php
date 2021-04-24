<?php


namespace App\Models;


use App\Concern\Latest;
use App\Concern\Me;
use App\Concern\PersianDate;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VoluntaryCertificate extends Model
{

    use UUID, Me, Latest, PersianDate, SoftDeletes;

    protected $table = 'voluntary_certificates';

    protected $fillable = ['user', 'voluntary_work', 'certificate', 'status'];

    public function getVoluntaryWork()
    {
        return $this->belongsTo(VoluntaryWork::class , "voluntary_work");
    }
}
