<?php


namespace App\Models;


use App\Concern\Latest;
use App\Concern\Me;
use App\Concern\PersianDate;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectReport extends Model
{

    use UUID, Me, Latest, PersianDate, SoftDeletes;

    protected $table = 'project_reports';

    protected $fillable = ['project', 'user', 'institutes', 'title', 'content', 'cover', 'status'];

}
