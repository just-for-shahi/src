<?php


namespace App\Http\Controllers\Account;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use SoftDeletes;
    protected $table = 'device_packages';
    protected $fillable = ['uuid', 'device', 'package', 'first_install', 'version_code', 'version_name'];

}