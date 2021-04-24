<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateInstitutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('institutes', function (Blueprint $table) {
            $table->string('ceo')->nullable()->change();
            $table->string('about')->nullable();
        });
        Schema::table('institute_branches', function (Blueprint $table) {
            $table->string('manager')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('institutes', function (Blueprint $table) {
            $table->tinyInteger('ceo')->change();
            $table->dropColumn('about');
        });
        Schema::table('institute_branches', function (Blueprint $table) {
            $table->tinyInteger('manager')->change();
        });
    }
}
