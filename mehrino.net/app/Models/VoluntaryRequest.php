<?php


namespace App\Models;


use App\Concern\Latest;
use App\Concern\Me;
use App\Concern\PersianDate;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VoluntaryRequest extends Model
{

    use UUID, Me, Latest, PersianDate, SoftDeletes;

    protected $table = 'voluntary_requests';

    protected $fillable = ['user', 'voluntary_work', 'resume', 'reject', 'private', 'status'];

    public function getVoluntaryWork()
    {
        return $this->belongsTo(VoluntaryWork::class , "voluntary_work");
    }
}
