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
            $table->bigIncrements('post_id');
            $table->integer('user_id');
            $table->string('title');
            $table->string('heading');
            $table->string('slug');
            $table->string('status');
            $table->string('image');
            $table->longText('description');
            $table->text('short_description');
            $table->string('meta_title', 255);
            $table->text('meta_description');            
            $table->string('type', 255);
            $table->string('template', 30)->default('default');
            $table->timestamps();
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
