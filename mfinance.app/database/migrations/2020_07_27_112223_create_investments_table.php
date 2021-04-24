<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investments', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->unsignedBigInteger('account');
            $table->foreign('account')->references('id')->on('accounts')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('agent')->nullable();
            $table->foreign('agent')->references('id')->on('accounts')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('branch');
            $table->foreign('branch')->references('id')->on('branches')->onUpdate('cascade')->onDelete('cascade');
            $table->tinyInteger('cryptocurrency')->default(0);
            $table->bigInteger('initial_deposit');
            $table->bigInteger('amount');
            $table->bigInteger('target');
            $table->tinyInteger('matching')->default(0);
            $table->timestamp('invested_at')->nullable();
            $table->timestamp('withdraw_at')->nullable();
            $table->string('last_change')->nullable();
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
        Schema::dropIfExists('investments');
    }
}
