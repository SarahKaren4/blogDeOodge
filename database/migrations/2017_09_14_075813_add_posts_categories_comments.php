<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPostsCategoriesComments extends Migration
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
            $table->string('alias')->unique();
            $table->string('title');
            $table->text('description');
            $table->string('image');
            $table->integer('user_id')->unsigned();
            $table->boolean('status');
            $table->string('meta_title');
            $table->string('meta_description');
            $table->timestamps();

            $table->foreign('user_id')
              ->references('id')->on('admins')
              ->onUpdate('cascade')->onDelete('cascade');;
        });

        Schema::create('comments', function(Blueprint $table) {
            $table->increments('id');
            $table->text('text');
            $table->integer('post_id')->unsigned();
            $table->string('user_type');
            $table->integer('user_id')->unsigned();
            $table->boolean('status');
            $table->timestamps();

            $table->foreign('post_id')
              ->references('id')->on('posts')
              ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('categories', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('meta_title');
            $table->string('meta_description');
            $table->boolean('status');
            $table->timestamps();
        });

        Schema::create('category_post', function(Blueprint $table) {
            $table->integer('category_id')->unsigned();
            $table->integer('post_id')->unsigned();

            $table->foreign('category_id')
              ->references('id')->on('categories')
              ->onUpdate('cascade')->onDelete('cascade');

              $table->foreign('post_id')
                ->references('id')->on('posts')
                ->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('comments');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('category_post');
    }
}
