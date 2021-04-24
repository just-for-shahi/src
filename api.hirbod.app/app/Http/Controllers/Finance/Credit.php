<?php


namespace App\Http\Controllers\Finance;


use App\Http\Controllers\Account\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Morilog\Jalali\Jalalian;

class Credit extends Model
{
    use SoftDeletes;
    protected $fillable = ['user', 'credit', 'type', 'description', 'status'];

    public function me() : BelongsTo{
        return $this->belongsTo(User::class, 'user')->where('user', auth()->id());
    }

    public function scopeLatest(Builder $query) : Builder{
        return $query->orderBy("created_at", "desc");
    }

    public function scopeSearch(Builder $query, ? string $q){
        if ($q){
            return $query->where(function($query) use ($q){
                return $query->orWhere("credit", "LIKE", "%{$q}%")
                    ->orWhere("type", "LIKE", "%{$q}%")
                    ->orWhere("status", $q);
            });
        }
        return $query;
    }

    /**
     * Get the jDate.
     *
     * @return string
     */
    public function getJCreatedAttribute() : string
    {
        return Jalalian::forge($this->created_at)->format(config('hirbod.date'));
    }

    /**
     * Get the jDate the updated
     *
     * @return string
     */
    public function getJUpdatedAttribute()
    {
        return $this->updated_at === null ? null : Jalalian::forge($this->updated_at)->format(config('hirbod.date'));
    }

}