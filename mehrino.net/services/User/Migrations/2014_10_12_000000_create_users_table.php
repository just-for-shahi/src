<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('name')->nullable();
            $table->string('mobile', 11)->unique()->nullable();
            $table->string('country', 8)->nullable();
            $table->integer('fee')->nullable();
            $table->string('code', 6)->nullable();
            $table->string('username')->nullable();
            $table->unsignedBigInteger('captain')->nullable();
            $table->foreign('captain')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('team')->default(0);
            $table->bigInteger('balance')->default(0);
            $table->boolean('blue')->default(false);
            $table->tinyInteger('role')->default(0);
            $table->timestamp('plus')->nullable();
            $table->string('avatar')->nullable();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->timestamp('last_connection')->nullable();
            $table->timestamp('code_expire')->nullable();
            $table->boolean('private')->default(false);
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
