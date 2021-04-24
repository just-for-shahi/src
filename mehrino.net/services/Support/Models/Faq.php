<?php


namespace Services\Support\Models;


use App\Concern\Latest;
use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faq extends Model
{
    use UUID, Latest, SoftDeletes;
    protected $fillable = ['uuid', 'parent', 'title', 'icon', 'content'];
}
