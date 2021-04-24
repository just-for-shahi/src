<?php


namespace App\Http\Controllers;


use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Search extends Model
{
    use SoftDeletes;
    protected $fillable = ['id', 'q', 'user','count'];

}