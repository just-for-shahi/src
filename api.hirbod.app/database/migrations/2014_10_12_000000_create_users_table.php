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
            $table->bigIncrements('id');
            $table->uuid('uuid');
            $table->string('name')->nullable();
            $table->string('mobile', 11)->unique()->nullable();
            $table->string('country', 10)->nullable();
            $table->integer('fee')->nullable();
            $table->string('code', 6)->unique()->nullable();
            $table->string('username')->nullable();
            $table->unsignedBigInteger('captain')->nullable();
            $table->foreign('captain')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('team')->default(0);
            $table->string('provider')->nullable();
            $table->string('provider_id')->nullable();
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
