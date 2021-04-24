<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateVoluntaryWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('voluntary_works', function (Blueprint $table) {
            $table->string('target_audience')->nullable()->change();
            $table->string('language')->default('')->change();
            $table->string('capacity')->default('')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('voluntary_works', function (Blueprint $table) {

            $table->tinyInteger('target_audience')->default(0)->change();
            $table->tinyInteger('language')->default(0)->change();
            $table->tinyInteger('capacity')->default(1)->change();
        });
    }
}
