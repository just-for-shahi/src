<?php


namespace App\Models;


use App\Concern\Latest;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use UUID, Latest, SoftDeletes;
    protected $fillable = ['parent', 'name', 'color', 'photo', 'type'];

    /**
     * Scope a query to search
     */
    public function scopeSearch(Builder $query, ? string $search)
    {
        if ($search) {
            return $query->where(function ($query) use ($search) {
                return $query->orWhere("name", "LIKE", "%{$search}%")
                    ->orWhere("parent", "LIKE", "%{$search}%")
                    ->orWhere("status", $search);
            });
        }
        return $query;
    }


}
