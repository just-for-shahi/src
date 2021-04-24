<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWithdrawsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdraws', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->unsignedBigInteger('account');
            $table->foreign('account')->references('id')->on('accounts')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('wallet')->nullable();
            $table->foreign('wallet')->references('id')->on('wallets')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('investment');
            $table->foreign('investment')->references('id')->on('investments')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('amount');
            $table->string('inquiry')->nullable();
            $table->string('receipt')->nullable();
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
        Schema::dropIfExists('withdraws');
    }
}
