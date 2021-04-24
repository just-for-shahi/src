<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoluntaryWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voluntary_works', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->unsignedBigInteger('user');
            $table->foreign('user')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('institutes')->nullable();
            $table->foreign('institutes')->references('id')->on('institutes')->onUpdate('cascade')->onDelete('cascade');
            $table->string('title');
            $table->tinyInteger('activity')->default(0);
            $table->tinyInteger('target_audience')->default(0);
            $table->tinyInteger('period')->default(0);
            $table->tinyInteger('language')->default(0);
            $table->string('location')->nullable();
            $table->double('latitude');
            $table->double('longitude');
            $table->string('address')->nullable();
            $table->tinyInteger('capacity')->default(1);
            $table->text('description')->nullable();
            $table->timestamp('from')->nullable();
            $table->timestamp('till')->nullable();
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('voluntary_works');
    }
}
