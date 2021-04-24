<?php


namespace App\Models;


use App\Concern\Latest;
use App\Concern\PersianDate;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InstituteWorkHours extends Model
{
    use UUID, Latest, PersianDate, SoftDeletes;

    protected $table = 'institute_work_hours';

    protected $fillable = ['saturday_start', 'saturday_end', 'sunday_start', 'sunday_end', 'monday_start',
        'monday_end', 'tuesday_start', 'tuesday_end', 'wednesday_start', 'wednesday_end', 'thursday_start',
        'thursday_end', 'friday_start', 'friday_end'];
}
