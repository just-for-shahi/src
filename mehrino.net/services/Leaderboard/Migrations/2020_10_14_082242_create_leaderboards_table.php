<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaderboardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leaderboards', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->unsignedBigInteger('user');
            $table->foreign('user')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('name');
            $table->tinyInteger('type')->default(0);
            $table->tinyInteger('achievement')->default(0);
            $table->tinyInteger('points')->default(0);
            $table->tinyInteger('rank')->default(0);
            $table->bigInteger('amount')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->boolean('private')->default(false);
            $table->nullableMorphs('leaderboardable');
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
        Schema::dropIfExists('leaderboards');
    }
}
