<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_comment', function (Blueprint $table) {
            $table->increments('id');
            $table->string('content', 200);
            $table->timestamps();
        });

        /* add foreign key for menu_comment table */
        Schema::table('menu_comment', function ($table) {
            /* id_menu colume references id of menu table */
            $table->integer('id_menu')->unsigned();
            $table->foreign('id_menu')->references('id')->on('menu')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::drop('menu_comment');
    }
}
