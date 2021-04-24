<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('code')->unique();
            $table->unsignedBigInteger('account');
            $table->foreign('account')->references('id')->on('accounts')->onUpdate('cascade')->onDelete('cascade');
            $table->string('name');
            $table->timestamp('open')->useCurrent();
            $table->string('country')->default('USA');
            $table->string('province')->default('CA');
            $table->string('city')->default('SA');
            $table->string('phone', 11)->nullable();
            $table->string('zip', 10)->nullable();
            $table->string('services')->default(0);
            $table->string('status')->default(0);
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('website')->nullable();
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
        Schema::dropIfExists('branches');
    }
}
