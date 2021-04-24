<?php


namespace Services\Chat\Models;


use App\Concern\Latest;
use App\Concern\Me;
use App\Concern\PersianDate;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Services\User\Models\User;

class Chat extends Model
{

    use UUID, Me, Latest, PersianDate, SoftDeletes;

    protected $fillable = ['user', 'chatable_id', 'chatable_type', 'title', 'description', 'logo',
        'pinned', 'username', 'type', 'private', 'status'];

    protected $hidden = ['id', 'chatable_type', 'chatable_id', 'deleted_at'];

    public function chatable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user');
    }
}
