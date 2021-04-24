<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApiServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_servers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ip');
            $table->string('title');
            $table->integer('api_server_status');
            $table->integer('mem');
            $table->string('cpu');
            $table->integer('enabled')->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('api_servers');
    }
}
