<?php


namespace App\Http\Controllers\Finance;


use App\Concern\Latest;
use App\Concern\Me;
use App\Concern\PersianDate;
use App\Concern\UUID;
use App\Facades\Persian\Persian;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use UUID, Me, Latest, SoftDeletes;
    protected $fillable = ['user', 'amount', 'description', 'authority', 'card_number', 'trace_number', 'status',
        'gateway', 'device', 'transactional_type', 'transactional_id', 'type'];

    public function getJCreatedAttribute() : string
    {
        return Persian::format($this->created_at);
    }

    public function getJUpdatedAttribute() : string
    {
        return Persian::format($this->updated_at);
    }

    /**
     * Scope a query to search posts
     * @param Builder $query
     * @param string|null $search
     * @return Builder
     */
    public function scopeSearch(Builder $query, ? string $search)
    {
        if ($search) {
            return $query->where(function ($query) use ($search) {
                return $query->orWhere("amount", "LIKE", "%{$search}%")
                    ->orWhere("description", "LIKE", "%{$search}%")
                    ->orWhere("card_number", "LIKE", "%{$search}%")
                    ->orWhere("status", $search);
            });
        }
        return $query;
    }
}