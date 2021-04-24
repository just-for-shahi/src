<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEbooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ebooks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid');
            $table->unsignedBigInteger('user');
            $table->foreign('user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('title');
            $table->string('year')->nullable();
            $table->string('cover')->nullable();
            $table->string('description')->nullable();
            $table->text('introduction')->nullable();
            $table->integer('readers')->default(0);
            $table->string('pages')->default(0);
            $table->string('sample')->nullable();
            $table->string('file')->nullable();
            $table->string('isbn', 13)->unique();
            $table->tinyInteger('level')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->string('token')->unique();
            $table->string('sample_token')->unique();
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
        Schema::dropIfExists('ebooks');
    }
}
