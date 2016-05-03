<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_comment', function (Blueprint $table) {
            $table->increments('id');
            $table->string('content', 200);
            $table->timestamps();
        });

        /* add foreign keys for post_comment table */
        Schema::table('post_comment', function ($table) {
            /* id_post colume references id of post table */
            $table->integer('id_post')->unsigned();
            $table->foreign('id_post')->references('id')->on('post')->onDelete('cascade')->onUpdate('cascade');
            /* id_user references id of user table */
            $table->integer('id_user')->unsigned();
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('post_comment');
    }
}
