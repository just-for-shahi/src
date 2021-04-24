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
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('username')->unique();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('mobile', 11)->unique()->nullable();
            $table->string('code', 6)->unique()->nullable();
            $table->unsignedBigInteger('captain')->nullable();
            $table->foreign('captain')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('team')->default(0);
            $table->string('password')->nullable();
            $table->tinyInteger('role')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->string('identity_no')->nullable();
            $table->string('identity_card_front')->nullable();
            $table->string('identity_card_back')->nullable();
            $table->timestamp('code_expire')->nullable();
            $table->string('avatar')->nullable();
            $table->string('confession')->nullable();
            $table->string('residential')->nullable();
            $table->string('phone')->unique()->nullable();
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
