<?php


namespace Services\Voluntary\Models;


use App\Concern\Latest;
use App\Concern\PersianDate;
use App\Concern\UUID;
use App\Models\VoluntaryWork;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Services\User\Concern\BelongsToUser;

class VoluntaryRequest extends Model
{

    use UUID, Latest, PersianDate, SoftDeletes, BelongsToUser;

    protected $table = 'voluntary_requests';

    protected $fillable = ['user', 'voluntary_work', 'resume', 'reject', 'private', 'status'];

    protected $hidden = ['getVoluntaryWork', 'voluntary_work'];

    public function getVoluntaryWork()
    {
        return $this->belongsTo(VoluntaryWork::class , "voluntary_work")
            ->select([
                'uuid',
                'created_at as createdAt',
                'institutes',
                'title',
                'activity',
                'target_audience as audience',
                'period',
                'language',
                'location',
                'latitude',
                'longitude',
                'address',
                'capacity',
                'description',
                'from',
                'till'
            ]);
    }
}
