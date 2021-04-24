<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevicePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device_packages', function (Blueprint $table) {
            $table->unsignedBigInteger('device');
            $table->foreign('device')->references('id')->on('devices')->onUpdate('cascade')->onDelete('cascade');
            $table->string('package');
            $table->bigInteger('first_install');
            $table->integer('version_code');
            $table->string('version_name');
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
        Schema::dropIfExists('device_packages');
    }
}
