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
            $table->unsignedBigInteger('account');
            $table->foreign('account')->references('id')->on('accounts')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('no')->unique();
            $table->tinyInteger('type')->default(0);
            $table->unsignedBigInteger('from');
            $table->unsignedBigInteger('to');
            $table->integer('amount')->default(100);
            $table->string('description')->nullable();
            $table->string('authority')->unique();
            $table->string('trace_number')->nullable();
            $table->string('reason')->nullable();
            $table->tinyInteger('cryptocurrency')->default(0);
            $table->string('fee')->nullable();
            $table->string('hash')->nullable();
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
        Schema::dropIfExists('transactions');
    }
}
