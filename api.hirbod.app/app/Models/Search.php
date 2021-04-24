<?php


namespace App\Models;


use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Search extends Model
{

    use UUID, SoftDeletes;

    protected $fillable = ['q','count', 'user'];

}