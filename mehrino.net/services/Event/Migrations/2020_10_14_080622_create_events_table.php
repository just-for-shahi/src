<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->unsignedBigInteger('user');
            $table->foreign('user')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamp('from')->nullable();
            $table->timestamp('till')->nullable();
            $table->string('location')->nullable();
            $table->string('title')->nullable();
            $table->text('introduction')->nullable();
            $table->string('cover')->nullable();
            $table->integer('contributor')->default(0);
            $table->string('address')->nullable();
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->bigInteger('price')->default(0);
            $table->bigInteger('specific_price')->nullable();
            $table->tinyInteger('live')->default(0);
            $table->tinyInteger('video')->default(0);
            $table->tinyInteger('dedicated')->default(0);
            $table->tinyInteger('private')->default(0);
            $table->tinyInteger('type')->default(0);
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
        Schema::dropIfExists('events');
    }
}
