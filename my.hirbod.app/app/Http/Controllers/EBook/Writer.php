<?php


namespace App\Http\Controllers\EBook;


use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Writer extends Model
{
    use UUID, SoftDeletes;
    protected $fillable = ['name'];

}
