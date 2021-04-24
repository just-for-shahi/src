<?php

namespace Services\Post\Models;

use App\Concern\Latest;
use App\Concern\Taggable;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Services\Category\Models\Category;

/**
 * Post
 * @author Sajadweb
 * Sun Jan 24 2021 14:52:20 GMT+0330 (Iran Standard Time)
 */
class Post extends Model
{
    use UUID, SoftDeletes, Latest , Taggable;

    protected $guarded = ['id'];

    protected $fillable = [
      'uuid','title','abstract','description','status','cover'
    ];

    public function categories()
    {
        return $this->morphToMany(Category::class , 'categorizable' , 'categorizable');
    }
}
