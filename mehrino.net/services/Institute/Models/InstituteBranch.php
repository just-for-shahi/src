<?php


namespace Services\Institute\Models;


use App\Concern\PersianDate;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InstituteBranch extends Model
{

    use UUID, PersianDate, SoftDeletes;

    protected $table = 'institute_branches';

    protected $fillable = ['institutes',
        'title', 'instagram',
        'telegram', 'aparat',
        'whatsapp', 'phone',
        'address', 'manager'];

    public function work_hours()
    {
        return $this->hasOne(InstituteBranchWorkHours::class, 'institute_branches');
    }
}
