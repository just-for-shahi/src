<?php


namespace Services\Institute\Models;


use App\Concern\Latest;
use App\Concern\PersianDate;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InstituteBranchWorkHours extends Model
{
    use UUID, Latest, PersianDate, SoftDeletes;

    protected $table = 'institute_branch_work_hours';

    protected $fillable = ['institute_branches','saturday_start', 'saturday_end', 'sunday_start', 'sunday_end', 'monday_start',
        'monday_end', 'tuesday_start', 'tuesday_end', 'wednesday_start', 'wednesday_end', 'thursday_start',
        'thursday_end', 'friday_start', 'friday_end'];
}
