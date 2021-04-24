<?php


namespace App\Models;


use App\Concern\Latest;
use App\Concern\UUID;
use App\Http\Controllers\Course\Course;
use App\Http\Controllers\EBook\EBook;
use App\Http\Controllers\Event\Event;
use App\Http\Controllers\Podcast\Podcast;
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
                return $query->orWhere("name", "LIKE", "%{$search}%");
            });
        }
        return $query;
    }

    public function ebooks(){
        return $this->morphedByMany(EBook::class, 'categorizable');
    }

    public function podcasts(){
        return $this->morphedByMany(Podcast::class, 'categorizable');
    }

    public function courses(){
        return $this->morphedByMany(Course::class, 'categorizable');
    }

    public function events(){
        return $this->morphedByMany(Event::class, 'categorizable');
    }

}