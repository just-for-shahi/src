<?php
  use Illuminate\Database\Migrations\Migration;
  use Illuminate\Database\Schema\Blueprint;
  use Illuminate\Support\Facades\Schema;

  class CreatePostsTable extends Migration
  {
      /**
       * Run the migrations.
       *
       * @return void
       */
      public function up()
      {
          Schema::create('posts', function (Blueprint $table) {
              $table->id();
              $table->uuid('uuid');
              $table->string('title');
              $table->text('abstract');
              $table->text('description');
              $table->enum('status' , [0 , 1])->default(1);
              $table->string('cover');
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
          Schema::dropIfExists('posts');
      }
  }
