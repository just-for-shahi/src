<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->unsignedBigInteger('user')->nullable();
            $table->foreign('user')->references('id')->on('users')->onDelete('cascade');
            $table->string('ip')->nullable();
            $table->tinyInteger('data_connection')->nullable();
            $table->string('operator_name')->nullable();
            $table->string('sim_operator')->nullable();
            $table->string('imei')->nullable();
            $table->string('android_id')->nullable();
            $table->string('java_vm_version')->nullable();
            $table->string('http_agent')->nullable();
            $table->string('os_arch')->nullable();
            $table->string('os_name')->nullable();
            $table->string('os_version')->nullable();
            $table->string('user_region')->nullable();
            $table->string('user_name')->nullable();
            $table->string('user_language')->nullable();
            $table->string('board')->nullable();
            $table->string('boot_loader')->nullable();
            $table->string('brand')->nullable();
            $table->string('cpu_abi')->nullable();
            $table->string('cpu_abi2')->nullable();
            $table->string('device')->nullable();
            $table->string('display')->nullable();
            $table->string('fingerprint')->nullable();
            $table->string('hardware')->nullable();
            $table->string('host')->nullable();
            $table->string('device_id')->nullable();
            $table->string('manufacturer')->nullable();
            $table->string('model')->nullable();
            $table->string('product')->nullable();
            $table->string('radio')->nullable();
            $table->string('serial')->nullable();
            $table->string('tags')->nullable();
            $table->string('time')->nullable();
            $table->string('type')->nullable();
            $table->string('locale')->nullable();
            $table->string('version_release')->nullable();
            $table->string('version_incremental')->nullable();
            $table->tinyInteger('version_sdk')->nullable();
            $table->string('package_name')->nullable();
            $table->tinyInteger('package_version_code')->nullable();
            $table->double('package_version_name')->nullable();
            $table->string('package_first_install')->nullable();
            $table->string('referrer')->nullable();
            $table->string('history')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('devices');
    }
}
