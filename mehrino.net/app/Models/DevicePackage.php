<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DevicePackage extends Model
{

    use SoftDeletes;

    protected $table = 'device_packages';

    protected $fillable = ['device', 'package', 'first_install', 'version_code', 'version_name'];

}
