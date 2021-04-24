<?php


namespace App\Models;


use App\Concern\PersianDate;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{

    use UUID, PersianDate, SoftDeletes;

    protected $table = 'categories';

    protected $fillable = ['parent', 'title', 'color', 'photo'];

    /**
     * Scope a query to search
     */
    public function scopeSearch(Builder $query, ? string $search)
    {
        if ($search) {
            return $query->where(function ($query) use ($search) {
                return $query->orWhere("title", "LIKE", "%{$search}%");
            });
        }
        return $query;
    }

}
