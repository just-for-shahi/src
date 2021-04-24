<?php


namespace Services\Project\Models;


use App\Concern\Latest;
use App\Concern\Me;
use App\Concern\PersianDate;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Services\Attachment\Concern\Attachable;
use Services\User\Models\User;

class ProjectReport extends Model
{

    use UUID, Me, Latest, PersianDate, SoftDeletes, Attachable;

    protected $table = 'project_reports';

    protected $fillable = ['project', 'user', 'institutes', 'title', 'content', 'cover', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user');
    }
}
