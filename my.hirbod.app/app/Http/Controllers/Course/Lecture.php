<?php


namespace App\Http\Controllers\Course;


use App\Concern\PersianDate;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lecture extends Model
{
    use UUID, PersianDate, SoftDeletes;
    protected $fillable = ['course', 'parent', 'title', 'duration', 'description', 'type', 'file', 'plus', 'status'];

}
