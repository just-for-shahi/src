<?php

namespace Services\Device\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Services\Device\Repositories\IDeviceRepository;

/**
 * Device
 * @author Sajadweb
 * Sun Dec 27 2020 13:25:38 GMT+0330 (Iran Standard Time)
 */
class DeviceController extends Controller
{

    private $repository;
    public function __construct(IDeviceRepository $repository)
    {
        // todo add repo
        $this->repository = $repository;
    }



    public function store(Request $request)
    {
        try {
            $request->merge(['user' => auth()->id()]);
            $this->repository->store($request->only([
                'user',
                'ip', 'data_connection', 'operator_name', 'sim_operator', 'imei',
                'android_id', 'java_vm_version', 'http_agent', 'os_arch', 'os_name', 'os_version', 'user_region',
                'user_name', 'user_language', 'board', 'boot_loader', 'brand', 'cpu_abi', 'cpu_abi2', 'device',
                'display', 'fingerprint', 'hardware', 'host', 'device_id', 'manufacturer', 'model', 'product',
                'radio', 'serial', 'tags', 'time', 'type', 'locale', 'version_release', 'version_incremental',
                'version_sdk', 'package_name', 'package_version_code', 'package_version_name', 'package_first_install',
                'referrer', 'history'
            ]));

            return Ok();
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }

    public function update($uuid, Request $request)
    {
        try {
            $this->repository->update($uuid, $request->only([
                'user',
                'ip', 'data_connection', 'operator_name', 'sim_operator', 'imei',
                'android_id', 'java_vm_version', 'http_agent', 'os_arch', 'os_name', 'os_version', 'user_region',
                'user_name', 'user_language', 'board', 'boot_loader', 'brand', 'cpu_abi', 'cpu_abi2', 'device',
                'display', 'fingerprint', 'hardware', 'host', 'device_id', 'manufacturer', 'model', 'product',
                'radio', 'serial', 'tags', 'time', 'type', 'locale', 'version_release', 'version_incremental',
                'version_sdk', 'package_name', 'package_version_code', 'package_version_name', 'package_first_install',
                'referrer', 'history'
            ]));
            return Ok();
        } catch (\Exception $exp) {
            InternalServerError500($exp);
        }
    }
}
