<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrokerServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('broker_servers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('enabled')->default('1');
            $table->integer('gmt_offset');
            $table->integer('sort_order')->nullable();
            $table->string('group_title')->nullable();
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
        Schema::dropIfExists('broker_servers');
    }
}
