<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid');
            $table->string('token')->unique();
            $table->unsignedBigInteger('account');
            $table->foreign('account')->references('id')->on('accounts')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('investment');
            $table->foreign('investment')->references('id')->on('investments')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('amount');
            $table->bigInteger('balance');
            $table->bigInteger('equity');
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
        Schema::dropIfExists('profits');
    }
}
