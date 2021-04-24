<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountManagementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_managements', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->unsignedBigInteger('account');
            $table->foreign('account')->references('id')->on('accounts')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('investment')->nullable();
            $table->foreign('investment')->references('id')->on('investments')->onUpdate('cascade')->onDelete('cascade');
            $table->tinyInteger('broker')->default(0);
            $table->string('username')->unique()->nullable();
            $table->string('password')->nullable();
            $table->string('investor_password')->nullable();
            $table->string('server')->nullable();
            $table->bigInteger('balance')->nullable();
            $table->bigInteger('equity')->nullable();
            $table->bigInteger('harvestable')->default(0);
            $table->tinyInteger('account_type')->default(0);
            $table->tinyInteger('report')->default(0);
            $table->boolean('dashboard')->default(0);
            $table->tinyInteger('trading_system')->default(0);
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('account_managements');
    }
}
