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
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('description', 100)->nullable();
            $table->string('user_description', 300)->nullable();
            $table->tinyInteger('currency');
            $table->bigInteger('amount');
            $table->bigInteger('balance')->nullable();
            $table->tinyInteger('type');
            $table->tinyInteger('status')->default(0);
            $table->string('trace_number', 50)->nullable();
            $table->string('ip', 50)->nullable();
            $table->unsignedBigInteger('bank_account_id')->nullable();
            $table->foreign('bank_account_id')->references('id')->on('bank_accounts')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('payment')->nullable();
            $table->string('payment_gateway', 50)->nullable();
            // [
            //     'website',
            //     'android',
            //     'ios',
            //     'robot'
            // ]
            $table->tinyInteger('via')->default(0);
            $table->string('receipt')->nullable();
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
