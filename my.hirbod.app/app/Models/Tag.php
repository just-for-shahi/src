<?php


namespace App\Models;


use App\Concern\Latest;
use App\Concern\Tagable;
use App\Concern\UUID;
use App\Http\Controllers\Course\Course;
use App\Http\Controllers\EBook\EBook;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use UUID, Latest, SoftDeletes;
    protected $fillable = ['uuid', 'name', 'color', 'photo'];

    public function courses(){
        return $this->morphedByMany(Course::class, 'taggable');
    }

    public function ebooks(){
        return $this->morphedByMany(EBook::class, 'taggable');
    }
}