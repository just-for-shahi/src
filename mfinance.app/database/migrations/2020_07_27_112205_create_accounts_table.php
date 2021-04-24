<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->smallInteger('country')->nullable();
            $table->string('mobile',11)->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('password')->nullable();
            $table->tinyInteger('otp')->unique()->nullable();
            $table->timestamp('otp_expire')->nullable();
            $table->string('avatar')->nullable();
            $table->string('phone', 11)->nullable();
            $table->string('address')->nullable();
            $table->string('zip', 10)->nullable();
            $table->string('no')->nullable();
            $table->string('username')->nullable();
            $table->unsignedBigInteger('captain')->nullable();
            $table->foreign('captain')->references('id')->on('accounts')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('ucoins')->default(0);
            $table->bigInteger('team')->default(0);
            $table->tinyInteger('role')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->timestamp('last_connection')->nullable();
            $table->bigInteger('balance')->default(0);
            $table->string('passport')->nullable();
            $table->text('client_id')->nullable();
            $table->text('client_secret')->nullable();
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
        Schema::dropIfExists('accounts');
    }
}
