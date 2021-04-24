<?php

namespace Services\Transaction\Models;

use App\Concern\Latest;
use App\Concern\Me;
use App\Concern\UUID;
use App\Facades\Persian\Persian;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Services\User\Models\User;

/**
 * Transaction
 * @author Sajadweb
 * Sun Dec 27 2020 14:05:43 GMT+0330 (Iran Standard Time)
 */
class Transaction extends Model
{
    use UUID, Me, Latest, SoftDeletes;
    protected $fillable = [
        'user', 'amount', 'description', 'authority', 'card_number', 'trace_number', 'status',
        'gateway', 'device', 'transactional_type', 'transactional_id', 'type', 'use_wallet'
    ];

    public function transactional() {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user', 'id');
    }

    public function related_txn()
    {
        return $this->morphOne($this, 'transactional');
    }

    public function getJCreatedAttribute()
    {
        return $this->created_at;
    }

    public function getJUpdatedAttribute()
    {
        return $this->updated_at;
    }

    /**
     * Scope a query to search posts
     * @param Builder $query
     * @param string|null $search
     * @return Builder
     */
    public function scopeSearch(Builder $query, ?string $search)
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
