<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEpisodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('episodes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid');
            $table->unsignedBigInteger('podcast');
            $table->foreign('podcast')->references('id')->on('podcasts')->onUpdate('cascade')->onDelete('cascade');
            $table->string('title');
            $table->bigInteger('plays')->default(0);
            $table->text('description')->nullable();
            $table->string('icon')->nullable();
            $table->string('file');
            $table->boolean('plus')->default(false);
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
        Schema::dropIfExists('episodes');
    }
}
