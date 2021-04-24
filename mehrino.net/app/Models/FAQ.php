<?php


namespace App\Models;


use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FAQ extends Model
{

    use UUID, SoftDeletes;

    protected $table = 'faqs';

    protected $fillable = ['parent', 'question', 'icon', 'answer', 'faqable_id', 'faqable_type', 'sort'];
}
