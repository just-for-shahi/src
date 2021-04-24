<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstituteBoardMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institute_board_members', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->unsignedBigInteger('institutes');
            $table->foreign('institutes')
                ->references('id')
                ->on('institutes')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('name');
            $table->string('position')->nullable();
            $table->text('introduction')->nullable();
            $table->string('avatar')->nullable();
            $table->string('website')->nullable();
            $table->string('instagram')->nullable();
            $table->string('telegram')->nullable();
            $table->string('aparat')->nullable();
            $table->string('linkedin')->nullable();
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
        Schema::dropIfExists('institute_board_members');
    }
}
