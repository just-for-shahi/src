<?php


namespace Services\Voluntary\Models;


use App\Concern\Latest;
use App\Concern\Me;
use App\Concern\PersianDate;
use App\Concern\UUID;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\VoluntaryWork;
class VoluntaryCertificate extends Model
{

    use UUID, Me, Latest, PersianDate, SoftDeletes;

    protected $table = 'voluntary_certificates';

    protected $fillable = ['user', 'voluntary_work', 'certificate', 'status'];

    public function getVoluntaryWork()
    {
        return $this->belongsTo(VoluntaryWork::class , "voluntary_work");
    }

//    public function getUser()
//    {
//        return $this->belongsTo(User::class , "user");
//    }
}
