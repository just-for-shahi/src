<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('text', 100);
            $table->string('ip');
            $table->string('user_agent');
            // [
            //     'login',
            //     'logout',
            //     'cardbank',
            //     'orders',
            //     'ticket',
            //     'auhtImgUser',
            //     'editUser',
            //     'editSettings',
            //     'finance',
            //     'notification',
            //     'editProfile',
            //     'sms2fa',
            //     'google2fa',
            // ]
            $table->tinyInteger('model');
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
        Schema::dropIfExists('logs');
    }
}
