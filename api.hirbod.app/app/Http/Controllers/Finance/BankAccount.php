<?php


namespace App\Http\Controllers\Finance;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Morilog\Jalali\Jalalian;

class BankAccount extends Model
{
    use SoftDeletes;
    protected $table = 'bank_accounts';
    protected $fillable = ['user', 'iban', 'card', 'account', 'status'];

    public function scopeGetLatest(Builder $query, int $count = 15, int $page = 1, ? string $search) : object
    {
        return $query->latest()->search($search)->paginate($count, ["*"], $page);
    }
    public function scopeMe(){
        return $this->where('user', auth()->id());
    }
    /**
     * Scope a query to only include  posted last.
     */
    public function scopeLatest()
    {
        return $this->orderBy("created_at", "desc");
    }

    /**
     * Scope a query to search
     */
    public function scopeSearch(Builder $query, ? string $search)
    {
        if ($search) {
            return $query->where(function ($query) use ($search) {
                return $query->orWhere("iban", "LIKE", "%{$search}%")
                    ->orWhere("card", "LIKE", "%{$search}%")
                    ->orWhere("account", "LIKE", "%{$search}%")
                    ->orWhere("status", $search);
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