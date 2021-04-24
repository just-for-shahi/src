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
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('google2fa')->nullable();
            $table->string('secret_question')->nullable();
            $table->string('secret_answer')->nullable();
            $table->tinyInteger('role')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->date('birthday')->nullable();
            $table->string('registered_ip');
            $table->tinyInteger('local_currency')->default(0);
            $table->unsignedBigInteger('invited_by')->nullable();
            $table->foreign('invited_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('firebase_token')->nullable();
            $table->string('telegram_token')->nullable();
            $table->bigInteger('daily_limit')->default(1000); // in USD
            $table->tinyInteger('type')->default(0);
            $table->tinyInteger('gender')->default(0);
            $table->string('username')->unique();
            $table->string('tax_id')->nullable();
            $table->string('mobile', 11)->unique()->nullable();
            $table->string('phone', 11)->nullable();
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
