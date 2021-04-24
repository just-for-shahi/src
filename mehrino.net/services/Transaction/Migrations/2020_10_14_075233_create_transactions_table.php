<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->unsignedBigInteger('user');
            $table->foreign('user')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->tinyInteger('currency')->default(0);
            $table->integer('amount')->default(100);
            $table->string('description')->nullable();
            $table->string('authority')->unique();
            $table->string('card_number')->nullable();
            $table->string('trace_number')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('gateway')->default(0);
            $table->unsignedBigInteger('device')->nullable();
            $table->foreign('device')->references('id')->on('devices')->onUpdate('cascade')->onDelete('cascade');
            $table->nullableMorphs('transactional');
            $table->tinyInteger('type')->default(0);
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
        Schema::dropIfExists('transactions');
    }
}
