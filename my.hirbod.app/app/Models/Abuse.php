<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Abuse extends Model
{
    use SoftDeletes;
    protected $fillable = ['user', 'type', 'status'];
}