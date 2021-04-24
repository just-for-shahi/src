<?php


namespace App\Http\Controllers\Podcast;


use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Episode extends Model
{
    use UUID,SoftDeletes;
    protected $fillable = ['podcast', 'title', 'plays', 'description', 'icon', 'file', 'plus', 'status'];
}