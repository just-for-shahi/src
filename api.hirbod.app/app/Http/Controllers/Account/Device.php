<?php


namespace App\Http\Controllers\Account;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Device extends Model
{
    use  SoftDeletes;
    protected $fillable = ['user', 'ip', 'data_connection', 'operator_name', 'sim_operator', 'imei', 'android_id',
        'java_vm_version', 'http_agent', 'os_arch', 'os_name', 'os_version', 'user_region', 'user_name', 'user_language', 'board', 'boot_loader',
        'brand', 'cpu_abi', 'cpu_abi2', 'device', 'display', 'fingerprint', 'hardware', 'host', 'device_id', 'manufacture', 'model', 'product',
        'radio', 'serial', 'tags', 'time', 'type', 'locale', 'version_release', 'version_incremental', 'version_sdk', 'package_name',
        'package_version_code', 'package_first_install', 'referrer', 'history'];

}