<?php


namespace App\Models;


use App\Concern\Latest;
use App\Concern\PersianDate;
use App\Concern\Tagable;
use App\Concern\UUID;
use App\Http\Controllers\Course\Course;
use App\Http\Controllers\EBook\EBook;
use App\Http\Controllers\Event\Event;
use App\Http\Controllers\Podcast\Podcast;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
use UUID, Latest, PersianDate, SoftDeletes;
    protected $fillable = ['name', 'color', 'photo'];

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
                return $query->orWhere("name", "LIKE", "%{$search}%");
            });
        }
        return $query;
    }

    public function courses(){
        return $this->morphedByMany(Course::class, 'taggable');
    }

    public function ebooks(){
        return $this->morphedByMany(EBook::class, 'taggable');
    }

    public function podcasts(){
        return $this->morphedByMany(Podcast::class, 'taggable');
    }

    public function events(){
        return $this->morphedByMany(Event::class, 'taggable');
    }

}