<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstitutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institutes', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->unsignedBigInteger('user');
            $table->foreign('user')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('title');
            $table->tinyInteger('type')->default(0);
            $table->string('logo')->nullable();
            $table->string('website')->nullable();
            $table->string('email')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('youtube')->nullable();
            $table->string('instagram')->nullable();
            $table->string('telegram')->nullable();
            $table->string('aparat')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('phone')->nullable();
            $table->string('registered')->nullable();
            $table->string('created')->nullable();
            $table->string('registered_no');
            $table->string('registered_name')->nullable();
            $table->string('license_no');
            $table->timestamp('license_expire')->nullable();
            $table->tinyInteger('license_provider')->default(0);
            $table->string('address')->nullable();
            $table->tinyInteger('statute')->default(0);
            $table->tinyInteger('activity_range')->default(0);
            $table->tinyInteger('ceo');
            $table->string('license_file')->nullable();
            $table->string('statute_file')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->bigInteger('covered_persons')->default(0);
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
        Schema::dropIfExists('institutes');
    }
}
