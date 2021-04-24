<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trades', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->unsignedBigInteger('account_management');
            $table->foreign('account_management')->references('id')->on('account_managements')->onUpdate('cascade')->onDelete('cascade');
            $table->tinyInteger('broker');
            $table->string('order');
            $table->timestamp('open')->nullable();
            $table->tinyInteger('type');
            $table->double('size');
            $table->string('symbol');
            $table->string('open_price');
            $table->string('sl');
            $table->string('tp');
            $table->timestamp('close')->nullable();
            $table->string('close_price');
            $table->string('swap');
            $table->string('commission');
            $table->string('result');
            $table->string('comment')->nullable();
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
        Schema::dropIfExists('trades');
    }
}
