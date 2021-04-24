<?php


namespace App\Models;


use App\Concern\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Visit extends Model
{
    use UUID, SoftDeletes;
    protected $fillable = ['user', 'previous', 'current', 'agent', 'device', 'visitable_type', 'visitable_id'];

}