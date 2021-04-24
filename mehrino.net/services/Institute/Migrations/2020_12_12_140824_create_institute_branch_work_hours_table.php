<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstituteBranchWorkHoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institute_branch_work_hours', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->unsignedBigInteger('institute_branches');
            $table->foreign('institute_branches')->references('id')->on('institute_branches')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamp('saturday_start')->nullable();
            $table->timestamp('saturday_end')->nullable();
            $table->timestamp('sunday_start')->nullable();
            $table->timestamp('sunday_end')->nullable();
            $table->timestamp('monday_start')->nullable();
            $table->timestamp('monday_end')->nullable();
            $table->timestamp('tuesday_start')->nullable();
            $table->timestamp('tuesday_end')->nullable();
            $table->timestamp('wednesday_start')->nullable();
            $table->timestamp('wednesday_end')->nullable();
            $table->timestamp('thursday_start')->nullable();
            $table->timestamp('thursday_end')->nullable();
            $table->timestamp('friday_start')->nullable();
            $table->timestamp('friday_end')->nullable();
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
        Schema::dropIfExists('institute_work_hours');
    }
}
