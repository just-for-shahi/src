<?php


namespace App\Http\Controllers\Course;


use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lecture extends Model
{
    use UUID, SoftDeletes;
    protected $fillable = ['course', 'parent', 'title', 'duration', 'type', 'file', 'plus', 'status'];

}