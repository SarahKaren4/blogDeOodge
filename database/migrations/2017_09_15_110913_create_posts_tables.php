<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug', 150)->unique();
            $table->string('image', 150);
            $table->boolean('status');
            $table->integer('user_id')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')
              ->references('id')->on('admins')
              ->onDelete('cascade');
        });

        Schema::create('post_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_id')->unsigned();
            $table->string('locale', 2)->index();
            $table->string('title', 150);
            $table->text('description');
            $table->string('meta_title', 150);
            $table->string('meta_description', 200);

            $table->unique(['post_id','locale']);

            $table->foreign('post_id')
              ->references('id')->on('posts')
              ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_translations');
        Schema::dropIfExists('posts');
    }
}
