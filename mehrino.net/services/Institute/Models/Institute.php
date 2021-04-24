<?php

namespace Services\Institute\Models;

use App\Concern\Distance;
use App\Concern\Latest;
use App\Concern\Me;
use App\Concern\PersianDate;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Services\Bookmark\Concern\Bookmarkable;
use Services\Follow\Concern\Followable;
use Services\Project\Models\Project;
use Services\User\Models\User;

/**
 * Institute
 * @author Sajadweb
 * Mon Dec 21 2020 14:19:14 GMT+0330 (Iran Standard Time)
 */
class Institute extends Model
{

    use UUID, Me, Latest, PersianDate, SoftDeletes, Bookmarkable, Followable , Distance;

    protected $table = 'institutes';

    protected $fillable = ['user', 'title', 'type', 'logo', 'website', 'email', 'linkedin', 'youtube', 'instagram',
        'telegram', 'aparat', 'whatsapp', 'phone', 'registered', 'created', 'registered_no', 'registered_name',
        'license_no', 'license_expire', 'license_provider', 'address', 'statute', 'activity_range', 'ceo',
        'license_file', 'statute_file', 'status', 'latitude', 'longitude', 'covered_persons', 'about'];

    public function my()
    {
        return $this->belongsTo(User::class, 'user');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user');
    }

    public function branch()
    {
        return $this->hasMany(InstituteBranch::class, 'institutes');
    }

    public function board_member()
    {
        return $this->hasMany(InstituteBoardMember::class, 'institutes');
    }

    public function work_hours()
    {
        return $this->hasOne(InstituteWorkHours::class, 'institutes');
    }

    public function projects()
    {
        return $this->hasMany(Project::class, 'institutes');
    }
}
